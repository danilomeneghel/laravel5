<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/images/grupols.ico" type="image/x-icon">
    <title>painel - Login</title>

    <link rel="stylesheet" href="/assets/packages/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/quirk.css">
    <script src="/assets/packages/modernizr/modernizr.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/packages/html5shiv/html5shiv.js"></script>
    <script src="/assets/packages/respond/respond.src.js"></script>
    <![endif]-->
  </head>

  <body class="signwrapper">
    <div class="sign-overlay"></div>
    <div class="signpanel"></div>
    <div class="panel signin">
      <div class="panel-heading">
        <h1>Leandro & Stormer</h1>        
      </div>
      <div class="panel-body">
        {!! Form::open(array('method' => 'post', 'url' => 'oauth', 'id' => 'loginForm')) !!}
          <div class="form-group mb10">
            <div class="input-group">
              <i class="glyphicon glyphicon-user"></i>
              <input type="text" class="form-control" name="username" placeholder="Usuário">
            </div>
          </div>
          <div class="form-group nomargin">
            <div class="input-group">
              <i class="glyphicon glyphicon-lock"></i>
              <input type="password" class="form-control" name="password" placeholder="Senha">
            </div>
          </div>
          <div class="msg-error"></div>
          <div><a href="" class="forgot">Esqueceu sua senha?</a></div>
          <div class="form-group">
            <button class="btn btn-success btn-quirk btn-block">Entrar</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

    <script src="/assets/packages/jquery/jquery.js"></script>
    <script src="/assets/packages/jquery-ui/jquery-ui.js"></script>
    <script src="/assets/packages/bootstrap/js/bootstrap.js"></script>
    <script src="/assets/packages/validation/jquery.form.js"></script>
    <script src="/assets/packages/validation/jquery.validate.min.js"></script>
    <script src="/assets/packages/validation/localization/messages_pt_BR.min.js"></script>
    <script src="/assets/packages/cookie/cookie.js"></script>
    <script src="/assets/js/RestClient.js"></script>

    <script type="text/javascript">
      $( document ).ready(function() {
        var oRestClient = new RestClient();

        $('#loginForm').validate({
          submitHandler: function(form) {
            $(form).ajaxSubmit({
                crossDomain: true,
                dataType: 'json',
                success: function (response)
                {
                    if(response.error == 'invalid_credentials') {
                        $( ".msg-error" ).html( "Usuário ou Senha Inválido!" );
                    } else {
                        oRestClient.setResponse(response);
                        oRestClient.setUrl('/clientes');
                        oRestClient.success();
                    }
                },
                error: function(error)
                {
                    $( ".msg-error" ).html( "Usuário ou Senha Inválido!" );
                }
            });
          },
          rules: {
            username: "required",
            password: "required"
          },
          messages: {
            username: "Campo Usuário deve ser preenchido!",
            password: "Campo Senha deve ser preenchido!"
          }
        });
      });
    </script>
  </body>
</html>