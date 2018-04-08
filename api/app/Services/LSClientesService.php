<?php

namespace api\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use api\Repositories\LSClientesLeadRepository;
use api\Repositories\LSClientesRepository;
use api\Repositories\LSEmailsRepository;
use api\Repositories\LSEnderecosRepository;
use api\Repositories\LSTelefonesRepository;
use api\Validators\LSClientesSiteValidator;
use api\Validators\LSClientesXPValidator;
use api\Validators\LSTelefonesValidator;
use api\Validators\LSEmailsValidator;
use api\Validators\LSClientesValidator;
use api\Validators\LSFieldsValidator;
use api\Validators\LSSenhaValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use \api\Entities\LSEmails;

class LSClientesService {

    /**
     * @var LSClientesRepository
     */
    protected $repository;

    /**
     * @var LSClientesLeadRepository
     */
    private $clientesLeadRepository;

    /**
     * @var LSEmailsRepository
     */
    private $emailsRepository;

    /**
     * @var LSTelefonesRepository
     */
    private $telefonesRepository;

    /**
     * @var LSEnderecosRepository
     */
    private $enderecosRepository;

    /**
     * @var LSEmailsService
     */
    private $emailsService;

    /**
     * @var LSTelefonesService
     */
    private $telefonesService;

    /**
     * @var LSEnderecosService
     */
    private $enderecosService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var CRMService
     */
    private $crmService;

    /**
     * @var LSClientesValidator
     */
    protected $validator;

    /**
     * @var LSClientesSiteValidator
     */
    private $clientesSiteValidator;

    /**
     * @var LSClientesXPValidator
     */
    private $clientesXPValidator;

    /**
     * @var LSEmailsValidator
     */
    private $emailsValidator;

    /**
     * @var LSTelefonesValidator
     */
    private $telefonesValidator;

    /**
     * @var LSSenhaValidator
     */
    private $senhaValidator;

    public function __construct(LSClientesRepository $repository, LSClientesValidator $validator, LSEmailsService $emailsService, LSTelefonesService $telefonesService, LSEnderecosService $enderecosService, UserService $userService, LSEmailsRepository $emailsRepository, LSTelefonesRepository $telefonesRepository, LSEnderecosRepository $enderecosRepository, LSClientesLeadRepository $clientesLeadRepository, LSClientesSiteValidator $clientesSiteValidator, LSClientesXPValidator $clientesXPValidator, LSTelefonesValidator $telefonesValidator, LSEmailsValidator $emailsValidator, LSSenhaValidator $senhaValidator, CRMService $crmService) {
        $this->repository = $repository;
        $this->clientesLeadRepository = $clientesLeadRepository;
        $this->emailsRepository = $emailsRepository;
        $this->telefonesRepository = $telefonesRepository;
        $this->enderecosRepository = $enderecosRepository;
        $this->emailsService = $emailsService;
        $this->telefonesService = $telefonesService;
        $this->enderecosService = $enderecosService;
        $this->userService = $userService;
        $this->crmService = $crmService;
        $this->validator = $validator;
        $this->clientesSiteValidator = $clientesSiteValidator;
        $this->clientesXPValidator = $clientesXPValidator;
        $this->emailsValidator = $emailsValidator;
        $this->telefonesValidator = $telefonesValidator;
        $this->senhaValidator = $senhaValidator;
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function create(array $data) {
        $msg = "";
        $dados = $data;
        if (isset($data['email'])) {
            if (is_array($data['email']))
                $dados['email'] = $data['email'][0]; //E-mail principal
            else
                $dados['email'] = $data['email'];
        }

        DB::beginTransaction();
        try {
            //Verifica se o usuário já está cadastrado (como cliente XP)
            if (isset($data['cpf_cnpj']))
                $data2 = $this->repository->findWhere(['cpf_cnpj' => $data['cpf_cnpj'], 'password' => null, 'ls_fontes_id' => 3]);

            if (!empty($data2['data'])) {
                $id = $data2['data'][0]['id'];
                //Valida os dados
                $this->clientesXPValidator->with($dados)->passesOrFail();
                //Verifica se o email já está cadastrado para outro usuário na tabela primária
                $emailPrimarioOutroUsuario = $this->repository->emailPrimarioOutroUsuario($id, $dados);
                //Verifica se o email já está cadastrado para outro usuário na tabela secundária
                $emailSecundarioOutroUsuario = $this->emailsRepository->emailSecundarioOutroUsuario($id, $dados);

                if ($emailPrimarioOutroUsuario && $emailSecundarioOutroUsuario) {
                    //Atualiza os dados do usuário já cadastrado na XP
                    $oCliente = $this->repository->skipPresenter()->update($dados, $id);

                    return $oCliente;
                } else {
                    $msg['email'][] = 'E-mail já cadastrado para outro usuário.';
                }
            } else {
                //Valida os dados
                $this->clientesSiteValidator->with($dados)->passesOrFail(ValidatorInterface::RULE_CREATE);
                
                $oCliente = $this->repository->skipPresenter()->create($dados);

                $oEmails = array();
                //Inseri os emails na tabela secundária
                if (isset($data['email']) && is_array($data['email']) && !empty($data['email'][0])) {
                    $dataEmail['ls_clientes_id'] = $oCliente->id;
                    foreach ($data['email'] as $key => $email) {
                        if ($key > 0) {
                            $dataEmail['email'] = $email;
                            //Valida o email antes de salvar no banco de dados
                            $this->emailsValidator->with($dataEmail)->passesOrFail(ValidatorInterface::RULE_CREATE);
                            $oEmail = $this->emailsService->create($dataEmail);
                            $oEmails['emails'][] = $oEmail['attributes'];
                        }
                    }
                } else if(!isset($data['email'])) {
                    $msg['email'][] = "Por favor, digite um e-mail válido.";
                }

                $oTelefones = array();
                //Inseri os telefones na tabela secundária
                if (isset($data['telefone']) && is_array($data['telefone']) && !empty($data['telefone'][0])) {
                    $dataTelefone['ls_clientes_id'] = $oCliente->id;
                    foreach ($data['telefone'] as $telefone) {
                        $dataTelefone['telefone'] = $telefone;
                        //Valida o telefone antes de salvar no banco de dados
                        $this->telefonesValidator->with($dataTelefone)->passesOrFail(ValidatorInterface::RULE_CREATE);
                        $oTelefone = $this->telefonesService->create($dataTelefone);
                        $oTelefones['telefones'][] = $oTelefone['attributes'];
                    }
                } else if (!empty($data['telefone'])) {
                    $dataTelefone['ls_clientes_id'] = $oCliente->id;
                    $dataTelefone['telefone'] = $data['telefone'];
                    //Valida o telefone antes de salvar no banco de dados
                    $this->telefonesValidator->with($dataTelefone)->passesOrFail(ValidatorInterface::RULE_CREATE);
                    $oTelefone = $this->telefonesService->create($dataTelefone);
                    $oTelefones['telefones'][] = $oTelefone['attributes'];
                } else {
                    $msg['telefone'][] = "Por favor, digite um telefone válido.";
                }
            }
            if (empty($msg)) {
                //Cadastro no CRM Pipedrive
                if (!empty($oCliente->id)) {
                    // parte temporária de código, o ideal é criar uma função aqui pois serão muitas fontes.
                    if ($data['ls_fontes_id'] == 1){
                        $title = 'Novo cadastro L&S Educação';
                    } else if($data['ls_fontes_id'] == 8){
                        $title = 'Novo cadastro L&S Quant'; 
                    } else if($data['ls_fontes_id'] == 6){
			$title = 'Novo cadastro L&S Análise';	
		    } else {
                        $title = 'Novo cadastro de fonte não identificada';
                    }

                    $hub = [0 => 1211773, 1 => 1277548]; //Para quem será atribuido a nova deal
                    $random = rand(0,1);
                    $user_id = $hub[$random];

                    //Inseri o novo cliente e novo negócio
                    $cadastro_crm = $this->cadastro_person_deal_crm($dados, $oCliente->id, $title, $user_id);

                    //Inseri uma atividade para o cliente
                    if ($cadastro_crm['success'] === true) {
                        $assunto = 'Boas-Vindas';
                        $atividade = 'call';
                        $data_vencimento = date('Y-m-d', strtotime("+2 days"));
                        $array_activities = array('subject' => $assunto, 'type' => $atividade, 'user_id' => $user_id, 'deal_id' => $cadastro_crm['data']['id'], 'person_id' => $cadastro_crm['data']['person_id']['value'], 'due_date' => $data_vencimento);

                        $this->crmService->create_activity_crm($array_activities);
                    }

                    //Caso de tudo certo salva os dados no banco de dados
                    DB::commit();

                    $result = array_merge($oCliente['attributes'], $oEmails, $oTelefones);

                    return $result;
                } else {
                    $msg['cadastro'][] = 'Erro ao cadastrar. Por favor, tente novamente.';
                }
            }
        } catch (ValidatorException $e) {
            //Se der algum erro faz o rollbak e não deixa salvar nada no banco de dados
            DB::rollBack();
            $msg = $e->getMessageBag();
        }
        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(array $data, $id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $id) {
            $msg = "";
            $dados = $data;
            if (isset($data['email'])) {
                if (is_array($data['email']))
                    $dados['email'] = $data['email'][0]; //E-mail principal
                else
                    $dados['email'] = $data['email'];
            }
            if (empty($data['password']))
                unset($dados['password']);

            DB::beginTransaction();
            try {
                $isEmptyEmailPrimario = false;
                $emailSecundarioOutroUsuario = false;

                //Valida os dados
                $this->clientesSiteValidator->with($dados)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                
                //Verifica se o email principal sofreu alguma alteração
                $dadosPrincipais = $this->repository->skipPresenter()->find($id, ['email', 'cpf_cnpj']);

                if (!empty($dados['email'])) {
                    $this->emailsValidator->with($dados)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                    //Verifica se o email já está cadastrado para outro usuário na tabela primária
                    $emailPrimarioOutroUsuario = $this->repository->emailPrimarioOutroUsuario($id, $dados);
                    //Verifica se o email já está cadastrado para outro usuário na tabela secundária
                    $emailSecundarioOutroUsuario = $this->emailsRepository->emailSecundarioOutroUsuario($id, $dados);
                    
                    if ($emailPrimarioOutroUsuario && $emailSecundarioOutroUsuario) {
                        //Verifica se existe o email na tabela secundária
                        $isEmptyEmailSecundario = $this->emailsRepository->findWhere(['ls_clientes_id' => $id, 'email' => $dados['email']])->isEmpty();

                        //Se existir o email secundário, mas queira mudar para primário, faz a alteração
                        if (!$isEmptyEmailSecundario) {
                            //Retorna os dados do email secundário
                            $emailSecundario = $this->emailsRepository->findWhere(['ls_clientes_id' => $id, 'email' => $dados['email']]);
                            try {
                                $data2 = $data3 = array();
                                $data2['ls_clientes_id'] = $id;
                                $data2['email'] = $dadosPrincipais['email'];
                                $data2['ls_fontes_id'] = $data['ls_fontes_id'];
                                $data2['disabled_at'] = date('Y-m-d H:i:s');

                                $data3['ls_clientes_id'] = $id;
                                $data3['email'] = $dados['email'];
                                $data3['ls_fontes_id'] = $data['ls_fontes_id'];
                                $data3['disabled_at'] = date('Y-m-d H:i:s');
                                //Copia o email para a tabela secundária
                                $this->emailsService->create($data2);
                                //Atualiza com a data atual no campo disabled
                                $this->emailsRepository->update($data3, $emailSecundario[0]['id']);
                            } catch (ValidatorException $e) {
                                $msg['cadastro'] = $e->getMessageBag();
                            }
                        } else {
                            //Caso o email tenha sido alterado e não existir no banco, inseri na tabela secundária
                            $data2 = array();
                            $data2['ls_clientes_id'] = $id;
                            $data2['email'] = $dadosPrincipais['email'];
                            $data2['ls_fontes_id'] = $data['ls_fontes_id'];
                            $data2['disabled_at'] = date('Y-m-d H:i:s');
                            $this->emailsService->create($data2);
                        }
                    } else {
                        $msg['email'][] = 'E-mail já cadastrado para outro usuário.';
                    }
                }

                //Atualiza todos os dados da tabela primária
                $oCliente = $this->repository->skipPresenter()->update($dados, $id);

                //Atualiza os emails da tabela secundária
                //Primeiro coloca todos os emails para disabled para criar os novos (forma mais simples)
                $this->emailsService->updateEmailsDisabled($id);

                $oEmails = array();
                if (isset($data['email']) && is_array($data['email']) && !empty($data['email'][0])) {
                    foreach ($data['email'] as $key => $email) {
                        if ($key > 0) {
                            //Localiza o email do cliente
                            $resultEmail = $this->emailsRepository->findWhere(['email' => $email, 'ls_clientes_id' => $id]);
                            if ($resultEmail->isEmpty()) {
                                //Cria o email enviado
                                $dataEmail = array();
                                $dataEmail['ls_clientes_id'] = $id;
                                $dataEmail['ls_fontes_id'] = $data['ls_fontes_id'];
                                $dataEmail['email'] = $email;
                                //Valida o email antes de salvar no banco de dados
                                $this->emailsValidator->with($dataEmail)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                                $oEmail = $this->emailsRepository->skipPresenter()->create($dataEmail);
                                $oEmails['emails'][] = $oEmail['attributes'];
                            } else {
                                $oEmail = $this->emailsRepository->skipPresenter()->update(['disabled_at' => null], $resultEmail[0]['id']);
                                $oEmails['emails'][] = $oEmail['attributes'];
                            }
                        }
                    }
                } else if(!isset($data['email'])) {
                    $msg['email'][] = "Por favor, digite um e-mail válido.";
                }

                //Atualiza os emails da tabela secundária
                //Primeiro coloca todos os emails para disabled para criar os novos (forma mais simples)
                $this->telefonesService->updateTelefonesDisabled($id);

                $oTelefones = array();
                if (isset($data['telefone']) && is_array($data['telefone']) && !empty($data['telefone'][0])) {
                    foreach ($data['telefone'] as $key => $telefone) {
                        $oTelefones = $this->atualiza_telefone($telefone, $id, $data['ls_fontes_id']);
                    }
                } else if (!empty($data['telefone'])) {
                    $oTelefones = $this->atualiza_telefone($data['telefone'], $id, $data['ls_fontes_id']);
                }
                
                if (empty($msg)) {
                    //Caso de tudo certo salva os dados no banco de dados
                    DB::commit();

                    $result = array_merge($oCliente['attributes'], $oEmails, $oTelefones);

                    return $result;
                }
            } catch (ValidatorException $e) {
                //Se der algum erro faz o rollbak e não deixa salvar nada no banco de dados
                DB::rollBack();
                $msg = $e->getMessageBag();
            }
        } else {
            $msg['permissao'] = 'Sem permissão de acesso!';
        }

        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

    public function atualiza_telefone($telefone, $id, $fontId) {
        //Localiza o telefone do cliente
        $resultTelefone = $this->telefonesRepository->findWhere(['telefone' => $telefone, 'ls_clientes_id' => $id]);
        if ($resultTelefone->isEmpty()) {
            //Cria o telefone enviado
            $dataTelefone = array();
            $dataTelefone['ls_clientes_id'] = $id;
            $dataTelefone['ls_fontes_id'] = $fontId;
            $dataTelefone['telefone'] = $telefone;
            //Valida o telefone antes de salvar no banco de dados
            $this->telefonesValidator->with($dataTelefone)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $oTelefone = $this->telefonesRepository->skipPresenter()->create($dataTelefone);
            $oTelefones['telefones'][] = $oTelefone['attributes'];
        } else {
            $oTelefone = $this->telefonesRepository->skipPresenter()->update(['disabled_at' => null], $resultTelefone[0]['id']);
            $oTelefones['telefones'][] = $oTelefone['attributes'];
        }

        return $oTelefones;
    }

    public function cadastro_person_deal_crm($data, $id, $title, $user_id) {
        $person = $this->cadastro_person_crm($data, $id);

        $deal = array();
        if ($person['success'] === true) {
            $data_fechamento = date('Y-m-d H:i:s', strtotime("+2 days"));
            $array_deals = array('title' => $title, 'person_id' => $person['id'], 'user_id' => $user_id, 'add_time' => date('Y-m-d H:i:s'), 'expected_close_date' => $data_fechamento);
            $deal = $this->crmService->create_deal_crm($array_deals);
            return $deal;
        } else {
            return $deal['success'] = false;
        }
    }

    public function cadastro_person_crm($data, $id) {
        $array_person = array('name' => $data['nome'], 'email' => $data['email'], 'dad0d8c23617343b4026edd6a387ffd00a8b0dee' => $id, 'add_time' => date('Y-m-d H:i:s'));
        $person = $this->crmService->create_person_crm($array_person);

        return $person;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update_lslive(array $data, $id) {
        try {
            return $this->repository->skipPresenter()->update($data, $id);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'error_type' => '',
                    'message' => $e->getMessageBag(),
                ],
            ];
            return response()->json($json, 400);
        }
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update_senha(array $data, $id) {
        try {
            $this->senhaValidator->with($data)->passesOrFail();
            return $this->repository->skipPresenter()->update($data, $id);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'error_type' => '',
                    'message' => $e->getMessageBag(),
                ],
            ];
            return response()->json($json, 400);
        }
    }

}
