<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Http\Request;
use LSAPI\Http\Requests;
use LSAPI\Http\Controllers\Controller;
use LSAPI\Repositories\LSContasMetaTraderRepository;
use LSAPI\Services\LSContasMetaTraderService;

class LSValidacaoRoboController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $dados = array();
        
        //Consulta no banco
        $dados = $this->repository->find($id);
        
        $dados['user_id'] = 1;
        $dados['nomeCliente'] = "João";
        $dados['nroConta'] = "123456";
        $dados['saldo'] = "1000";
        $dados['nomeRobo'] = "robo01";
        $dados['tipoConta'] = "real";
        $dados['ativo'] = 1;
        $dados['timeframe'] = "";
        $dados['inicioUtilizacao'] = "01/05/2016";
        $dados['versaoRobo'] = "1.05";
        
        $dados = $this->encode($dados);
        
        return $dados;
    }

    public function encode($in) {
        $str = strtr(base64_encode($in), 
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", 
                "a56qxPtfiNOloBRAugEbj97yh3Z6vzKFGCcmHSLrpQ0TdDVIWsYnMwJ4Xe1Uk2");
        return $str;
    }

    public function decode($in) {
        $str = base64_decode(strtr($in, 
                "a56qxPtfiNOloBRAugEbj97yh3Z6vzKFGCcmHSLrpQ0TdDVIWsYnMwJ4Xe1Uk2", 
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"));
        return $str;
    }

}
