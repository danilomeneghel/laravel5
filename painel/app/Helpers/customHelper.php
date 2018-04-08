<?php

if(! function_exists("api_url") )
{
    function api_url( $sUrl = '' )
    {
        return env("API_BASEURL","http://localhost") . $sUrl;
    }
}