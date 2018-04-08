RestClient = function() {}

$.extend(RestClient.prototype, {
    //Object variables
    response: '',
    url: '',

    setResponse: function( response )
    {
        this.response = response;
    },
    setUrl: function( url )
    {
        this.url = url;
    },
    success: function()
    {
        var response = this.response;
        var url = this.url;
        
        //Variables cookies
        Cookies.set('access_token', response.access_token, {expires: 1});
        Cookies.set('refresh_token', response.refresh_token, {expires: 1});
        Cookies.set('user_name', response.user_name, {expires: 1});
        Cookies.set('user_type', response.user_type, {expires: 1});
        
        //Redirect
        $(location).attr('href', url);
    },
    error: function()
    {
        var response = this.response;
        switch (response.status)
        {
            case 400:
                alert("400 error");
            break;
            case 401:
                alert("401 error");
            break;
            case 402:
                alert("402 error");
            break;
            case 403:
                alert("403 error");
            break;
            case 404:
                alert("404 error");
            break;
            case 500:
                alert("500 error");
            break;
        }
    }
});