@extends('layouts.default')

@section('content')
    <div class="contentpanel">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading nopaddingbottom">
                        <h4 class="panel-title">Cadastro de novos clientes</h4>
                        <p>Por favor, informe nome, e-mail e senha, para cadastrar um novo usuário do sistema.</p>
                    </div>
                    <div class="panel-body">
                        <hr>
                        {!! Form::open(array('method' => "POST", 'url' => $url, 'id' => 'userForm', 'class' => 'form-horizontal')) !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nome <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome..." required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-mail <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail..." required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Senha <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha..." required />
                                    <small> (minimo 6 caracteres)</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Repetir Senha <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" name="repeat_password" id="repeat_password" class="form-control" placeholder="Repita sua senha..." required />
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tipo <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    {!! Form::select('type', $tipos) !!}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Setor <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    {!! Form::select('setor', $setores) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pipedrive Id <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pipedrive_id" id="email" class="form-control" placeholder="Digite o Id Pipedrive..." required />
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-success btn-quirk btn-wide mr5">Salvar</button>
                                    <button type="reset" class="btn btn-quirk btn-wide btn-default">Limpar</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div>
        </div>
    </div>
@stop

@section('extra_styles')

@stop  

@section('extra_scripts')
    <script type="text/javascript">

        $( document ).ready(function() {

            var oNotification = new Notification();

            $('#userForm').validate({
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        crossDomain: true,
                        dataType: 'json',
                        success: function (response)
                        {
                            oNotification.setResponse(response);
                            oNotification.setUrl("/user");
                            oNotification.setUrlRedirect("/usuarios");
                            oNotification.setSuccessMsg('Usuário salvo com sucesso.');
                            oNotification.success();
                            oNotification.render();
                        },
                        error: function(error)
                        {
                            oNotification.setResponse(error);
                            oNotification.setUrl(false);
                            oNotification.error();
                            oNotification.render();
                        }
                    });
                },
                rules: {
                    name: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    repeat_password: {
                        equalTo: '#password'
                    }
                },
                messages: {
                    name: 'Campo NOME deve ser preenchido!',
                    email: {
                        required: 'Campo EMAIL deve ser preenchido!',
                        email: 'Campo EMAIL deve ser um e-mail valido!'
                    },
                    repeat_password: {
                        equalTo: 'Campo REPETIR SENHA deve ter o mesmo valor do campo SENHA'
                    }
                }
            });

            configureForm();
        });

        function configureForm()
        {
            var id = '{!! (!empty($id) ? $id : false) !!}';
            if (typeof id !== 'undefined' && id) {
                var sUrl = setUrl("usuarios/" + id);
                $.ajax({
                    url         : sUrl,
                    dataType    : 'json',
                    type        : "GET",
                    data        : {},
                    success     : function( data ) {
                        var oJson = data.data;
                        $("<input>").attr("type","hidden").attr("name","_method").val("PUT").appendTo("#userForm");
                        $(".panel-title").text("Edição de usuário: " + oJson.id + "-" + oJson.name);
                        $(".panel-title").next("p").text("Por favor, informe os campos que deseja alterar. Atenção, só preencha o campo SENHA caso deseje altera-la");
                        $("#password").removeAttr('required');
                        $("#repeat_password").removeAttr('required');

                        $("#name").val(oJson.name);
                        $("#email").val(oJson.single_email);
                    }
                });
            }
        }
    </script>
@stop