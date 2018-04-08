<?php

namespace LSPainel\Http\Controllers;

use Illuminate\Http\Request;

use LSPainel\Http\Requests;
use LSPainel\Http\Controllers\Controller;

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
