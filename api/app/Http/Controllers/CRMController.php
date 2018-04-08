<?php

namespace LSAPI\Http\Controllers;

use LSAPI\Repositories\CRMRepository;
use LSAPI\Services\CRMService;
use Illuminate\Http\Request;

class CRMController extends Controller {

    /**
     * @var CRMRepository
     */
    private $repository;
    /**
     * @var CRMService
     */
    private $service;

    /**
     * CRMController constructor.
     */
    public function __construct(CRMRepository $repository, CRMService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function create_person_crm(Request $request) {
        return $this->service->create_person_crm($request->all());
    }
    
    public function create_deal_crm(Request $request) {
        return $this->service->create_deal_crm($request->all());
    }
    
    public function create_activity_crm(Request $request) {
        return $this->service->create_activity_crm($request->all());
    }

}
