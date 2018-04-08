<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Http\Request;
use LSAPI\Http\Controllers\Controller;
use LSAPI\Repositories\LSContasMetaTraderRepository;
use LSAPI\Repositories\LSContasRobosRepository;
use LSAPI\Services\LSContasMetaTraderService;
use LSAPI\Services\LSContasRobosService;

class LSContasMetaTraderController extends Controller
{
    /**
     * @var LSContasMetaTraderRepository
     */
    private $repository;
    /**
     * @var LSContasMetaTraderService
     */
    private $service;
    /**
     * @var LSContasMetaTraderRepository
     */
    private $robosRepository;
    /**
     * @var LSContasMetaTraderService
     */
    private $robosService;

    /**
     * LSContasMetaTraderController constructor.
     */
    public function __construct(LSContasMetaTraderRepository $repository, LSContasMetaTraderService $service, LSContasRobosRepository $robosRepository, LSContasRobosService $robosService)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->robosRepository = $robosRepository;
        $this->robosService = $robosService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->scopeQuery(function($query){
            return $query->orderBy('id');
        })->paginate(24);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function useRobot($data)
    {
        if(!empty($data)) {
            $param = $this->decode($data);
            $param = explode("&", $param);

            $dados = array();
            $result = "";
            $contaMT5 = 0;
            $success = 0;
            $key_error = '';
            $error = '';
            $key_robo = '';
            $data_criacao = '';
            
            if(is_array($param) && !empty($param)) {
                foreach($param as $k => $v) {
                    $p = explode("=", $v);
                    $campo = $p[0];
                    $valor = $p[1];

                    $dadosMT5[$campo] = $valor;
                }
            }
            
            //Verifica se a conta é do tipo demo ou real e se está cadastrado no banco de dados
            if($dadosMT5['tipoConta'] == '0' && $dadosMT5['serverName'] == 'XPMT5-Demo') {
                $contaMT5 = substr($dadosMT5['numero_conta'],2,20);
            } else if($dadosMT5['tipoConta'] == '1' && $dadosMT5['serverName'] == 'XPMT5-PRD') {
                $contaMT5 = $dadosMT5['numero_conta'];
            }
            
            $result = $this->repository->findWhere(['conta_real' => $contaMT5]);
                        
            if(is_array($result['data']) && !empty($result['data'])) {
                $data_inicio = $dadosMT5['InicioUtilizacao'];
                $dado = $result['data'][0];
                
                //Verificação dos dados do cliente
                if ((trim(strtoupper($dadosMT5['nome'])) == trim(strtoupper($dado['nome'])))) {
                    $this->insertUse($contaMT5, $data_inicio);
                    $success = 1;
                } else {
                    $success = 0;
                    $key_error = 1;
                    $error = 'Nome de usuário inválido ou não cadastrado.';
                }
                                
                //Verificação dos dados do robo
                if(!$dado['conta_robo']->isEmpty()) {
                    foreach($dado['conta_robo'] as $robo) {
                        //Numeros de contas demos que podem existir
                        $conta_demo = array('50'.$contaMT5, '60'.$contaMT5, '70'.$contaMT5, '80'.$contaMT5, '90'.$contaMT5);
                        
                        //Verifica se a conta real ou demo está liberada para o numero de conta acessada pelo MT5
                        if(($contaMT5 == $dado['conta_real'] && !empty($robo['permissao_real']) && $robo['permissao_real'] <= date('Y-m-d')) || 
                            (in_array($contaMT5, $conta_demo) && !empty($robo['permissao_demo']) && $robo['permissao_demo'] <= date('Y-m-d'))) {
                            $data_criacao = $robo['created_at'];
                            //Verifica se tem saldo limite para operar no MT5
                            if(!empty($robo['limite']) && $dadosMT5['saldo'] <= (double)$robo['limite']*1.2) {
                                $this->insertUse($contaMT5, $data_inicio);
                                $success = 1;
                                continue;
                            } else {
                                $success = 0;
                                $key_error = 3;
                                $error = 'Saldo insuficiente para operar.';
                            }
                        } else {
                            $success = 0;
                            $key_error = 4;
                            $error = 'Robo ainda não liberado. Favor entrar em contato com o departamento financeiro.';
                        }
                    }
                } else {
                    $success = 0;
                    $key_error = 6;
                    $error = 'Robo não cadastrado para esse cliente. Favor entrar em contato.';
                }
            } else {
                $success = 0;
                $key_error = 5;
                $error = 'Conta não encontrada. Favor entrar em contato.';
            }

            $key_robo = $dadosMT5['parametros']*7;

            //Converte os caracteres para ANSI do MT5
            $error_ansi = iconv("UTF-8", "Windows-1252", $error);
            
            return $this->encode($success . ";" .  $key_robo . ";" . $data_criacao . ";" . $key_error . ";" . $error_ansi);
        }
    }

    public function insertUse($contaMT5, $data_inicio) {
        //Localiza a conta se está cadastrada
        $conta_metatrader = $this->repository->findWhere(['conta_real' => $contaMT5]);
        
        //Caso a conta exista, inseri no banco a data de uso do robo
        if(!empty($conta_metatrader['data'])) {
            //Verifica se a data já foi inserida anteriormente
            $meta_trader_id = $conta_metatrader['data'][0]['id'];
            $conta_robo = $this->robosRepository->findWhere(['ls_contas_meta_trader_id' => $meta_trader_id]);
            
            //Caso ainda não tenha sido inserida a data, inseri a data atual
            if(!empty($conta_robo['data'])) {
                $this->robosService->update(['inicio_uso' => $data_inicio], $conta_robo['data'][0]['id']);
            }
        }
    }

    public function encode($in) {
        $str = strtr(base64_encode($in), 
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789=", 
                "hIg4xJjCZlDSvUWscV9yoMqLb3PXKNdAt7OGT8fmuin2ear05pQzwkFB1R6YHE=");
        return $str;
    }

    public function decode($in) {
        $str = base64_decode(strtr($in, 
                "hIg4xJjCZlDSvUWscV9yoMqLb3PXKNdAt7OGT8fmuin2ear05pQzwkFB1R6YHE=", 
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789="));
        return $str;
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function search($search_field)
    {
        return $this->repository->search($search_field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
    
}
