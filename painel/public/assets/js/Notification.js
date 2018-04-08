Notification = function() {};

$.extend($.gritter.options, {
    class_name: 'gritter-light', // for light notifications (can be added directly to $.gritter.add too)
    fade_in_speed: 100, // how fast notifications fade in (string or int)
    fade_out_speed: 100, // how fast the notices fade out
    time: 3000 // hang on the screen for...
});

$.extend(Notification.prototype, {

    // object variables
    response: '',
    url: '',
    msg: '',
    setup: '',

    setResponse: function( response )
    {
        this.response = response;
    },
    setUrl: function( url )
    {
        this.url = url;
    },
    setUrlRedirect: function( urlRedirect )
    {
        this.urlRedirect = urlRedirect;
    },
    setSuccessMsg: function( msg )
    {
        this.msg = msg;
    },
    success: function() {
        var setup    = new Object();
        var response = this.response;
        var url      = this.url;
        var urlRedirect      = this.urlRedirect;

        setup.title       = 'Sucesso!';
        setup.text        = this.msg;
        setup.class_name  = 'with-icon check-circle success';
        setup.after_close = function() {
            if( url ) {
                $(location).attr('href', urlRedirect);
            }
        };

        if ( typeof response.error !== 'undefined' && response.error ) {

            setup.title = 'Erro!';
            setup.text = response.message;
            setup.class_name = 'with-icon check-circle danger';
            setup.time = 5000;
            setup.after_close = function() {};
        }

        this.setup = setup;
    },
    error: function()
    {
        var response = this.response;
        var setup    = new Object();
        var url      = this.url;

        switch (response.status)
        {
            case 400:
                setup.title = 'Erro!';
                setup.text = 'Pagina não encontrada';
                setup.class_name = 'with-icon check-circle danger';
                break;
            case 401:
                setup.title = 'Erro!';
                setup.text = 'Você não possui permissão de acesso.';
                setup.class_name = 'with-icon check-circle danger';
                break;
            case 403:
                setup.title = 'Erro!';
                setup.text = 'Você não possui permissão de acesso.';
                setup.class_name = 'with-icon check-circle danger';
                break;
            case 404:
                setup.title = 'Erro!';
                setup.text = 'URL não encontrada';
                setup.class_name = 'with-icon check-circle danger';
                break;
            case 500:
                setup.title = 'Erro!';
                setup.text = 'Ocorreu um erro inesperado! Você será direcionado para a tela de login! Realize o login novamente.';
                setup.class_name = 'with-icon check-circle danger';
                break;
        }

        setup.after_close = function() {
            if( url ) {
                $(location).attr('href', url);
            }
        };
        setup.time = 5000;
        this.setup = setup;
    },
    render: function()
    {
        $.gritter.add(this.setup);
    }

});
