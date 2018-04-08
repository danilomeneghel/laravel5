<?php

namespace LSAPI\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use LSAPI\Repositories\LSParceirosRepository;
use LSAPI\Validators\LSParceirosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSParceirosService {

    /**
     * @var LSParceirosRepository
     */
    private $repository;

    /**
     * @var LSParceirosValidator
     */
    private $validator;

    /**
     * LSParceirosService constructor.
     * @param LSParceirosRepository $repository
     * @param LSParceirosValidator $validator
     */
    public function __construct(LSParceirosRepository $repository, LSParceirosValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            //Valida os dados
            $this->validator->with($data)->passesOrFail();
            
            return $this->repository->skipPresenter()->create($data);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => ['message' => $e->getMessageBag()]
            ];
            return response()->json($json, 400);
        }
    }

    public function update(array $data, $id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $data['ls_clientes_id']) {
            try {
                //Valida os dados
                $this->validator->with($data)->passesOrFail();
                
                return $this->repository->skipPresenter()->update($data, $id);
            } catch (ValidatorException $e) {
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

}
