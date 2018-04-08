<?php

namespace painel\Http\Controllers;

use Illuminate\Http\Request;

use painel\Http\Requests;
use painel\Http\Controllers\Controller;

class DashboardController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      return view('pages.dashboard');
    }
}
