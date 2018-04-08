<?php

namespace LSAPI\Services;

use LSAPI\Repositories\CRMRepository;
use LSAPI\Repositories\LSClientesRepository;

class CRMService {

    /**
     * @var CRMRepository
     */
    protected $repository;
    protected $clientesRepository;
    protected $tokenCrm;

    /**
     * @param CRMRepository $repository
     */
    public function __construct(CRMRepository $repository, LSClientesRepository $clientesRepository) {
        $this->repository = $repository;
        $this->clientesRepository = $clientesRepository;

        $this->tokenCrm = '9456903a6df0012b21416990c88beffbbe23d219';

        $this->urlPersonCrm = 'https://api.pipedrive.com/v1/persons?api_token=' . $this->tokenCrm;
        $this->findPersonCrm = 'https://api.pipedrive.com/v1/persons/find?start=0&search_by_email=1&api_token=' . $this->tokenCrm;
        $this->urlDealCrm = 'https://api.pipedrive.com/v1/deals?api_token=' . $this->tokenCrm;
        $this->urlActivityCrm = 'https://api.pipedrive.com/v1/activities?api_token=' . $this->tokenCrm;
    }

    public function create_person_crm($dados) {
        //Verifica se o cliente já está cadastrado no banco de dados
        if (!isset($dados['dad0d8c23617343b4026edd6a387ffd00a8b0dee'])) {
            $cliente = "";
            if (isset($dados['email']) && !empty($dados['email']))
                $cliente = $this->clientesRepository->findWhere(['email' => $dados['email']]);
            
            if (is_array($cliente) && !empty($cliente['data'][0]['id'])) {
                $dados['dad0d8c23617343b4026edd6a387ffd00a8b0dee'] = $cliente['data'][0]['id'];
            } else if (isset($dados['cdf4297315b1834d060eba7cf1f73d20944b4977']) && !empty($dados['cdf4297315b1834d060eba7cf1f73d20944b4977'])) {
                $cliente = $this->clientesRepository->findWhere(['cpf_cnpj' => $dados['cdf4297315b1834d060eba7cf1f73d20944b4977']]);
                
                if (!empty($cliente['data'][0]['id']))
                    $dados['dad0d8c23617343b4026edd6a387ffd00a8b0dee'] = $cliente['data'][0]['id'];
            }
        }

        //Faz a consulta no Pipedrive para verificar se o cliente já havia sido cadastrado anteriormente
        $findPersonCrm = $this->findPersonCrm . '&term=' . $dados['email'];
        $person = $this->performCurl(null, $findPersonCrm, 'get', $dados);
        $success = array();

        //Verifica se o cliente já está cadastro no Pipedrive, caso esteja retorna o mesmo usuário sem cadastra-lo novamente
        if (!empty($person['data'])) {
            $success['success'] = true;
            $result = array_merge($success, $person['data'][0]);

            return $result;
        } else {
            $result = $this->performCurl(null, $this->urlPersonCrm, 'post', $dados);
            if (!empty($result['data'])) {
                $success['success'] = true;
                $result = array_merge($success, $result['data']);
            }

            return $result;
        }
    }

    public function create_deal_crm($dados) {
        return $this->performCurl(null, $this->urlDealCrm, 'post', $dados);
    }

    public function create_activity_crm($dados) {
        return $this->performCurl(null, $this->urlActivityCrm, 'post', $dados);
    }

    protected function performCurl($header = null, $url, $method, $fields = null) {
        $data = curl_init();

        if (!empty($header)) {
            curl_setopt($data, CURLOPT_HTTPHEADER, $header);
        }

        switch ($method) {
            case "post":
                curl_setopt($data, CURLOPT_POST, count($fields));
                curl_setopt($data, CURLOPT_POSTFIELDS, http_build_query($fields));
                break;
            case "put":
                curl_setopt($data, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($data, CURLOPT_POSTFIELDS, http_build_query($fields));
                break;
            default:
                break;
        }

        curl_setopt($data, CURLOPT_URL, $url);
        curl_setopt($data, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($data);
        $result = json_decode($result, true);

        curl_close($data);

        return $result;
    }

}
