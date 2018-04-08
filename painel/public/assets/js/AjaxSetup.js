sAccessToken    = Cookies.get('access_token');
sRefreshToken   = Cookies.get('refresh_token');

$.ajaxSetup({
    crossDomain : true,
    beforeSend: function (xhr)
    {
        xhr.setRequestHeader( "Authorization", "Bearer " + sAccessToken );
        Pace.restart();
    },
    error: function(error)
    {
        var oNotification = new Notification();
        switch (error.status)
        {
            case 400:
                console.log("400 error");
                break;
            case 401:
                break;
            case 402:
                console.log("402 error");
                break;
            case 403:
                _refresh();
                break;
            case 404:
                console.log("404 error");
                break;
            case 500:
                oNotification.setResponse(error);
                oNotification.setUrl(false);
                oNotification.error();
                oNotification.render();
                break;
        }
    }
});

function _refresh()
{
    var oData = {
        "refresh_token": sRefreshToken,
        "client_id": "893146295ad3c6039ba11a0b205bd455",
        "client_secret": "secret",
        "grant_type": "refresh_token"
    };
    var sUrl            = setUrl("oauth/access_token");
    $.ajax({
        url         : sUrl,
        crossDomain : true,
        dataType    : 'json',
        type        : "POST",
        data        : oData,
        success     : function( response )
        {
            Cookies.set('access_token', response.access_token, {expires: 1});
            Cookies.set('refresh_token', response.refresh_token, {expires: 1});
            sAccessToken    = response.access_token;
            sRefreshToken   = response.refresh_token;
            ajaxRequest();
        },
        error       : function( error )
        {
            console.log(error);
        }
    });
}
