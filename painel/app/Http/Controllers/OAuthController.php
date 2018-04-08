<?php

namespace painel\Http\Controllers;

use Illuminate\Http\Request;

use painel\Http\Requests;
use painel\Http\Controllers\Controller;

class OAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['client_id'] = env('APP_NAME');
        $request['client_secret'] = 'secret';
        $request['grant_type'] = 'password';
        $request['scope'] = 'painel';
        
        $url = api_url('oauth/access_token');
        
        $this->performCurl(null, $url, 'post', $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        $result = curl_exec($data);
        $result = json_decode($result, true);

        curl_close($data);

        return $result;
    }

}
