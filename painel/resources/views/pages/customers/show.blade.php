@extends('layouts.default')

@section('content')
    {{-- Content here --}}

    <div class="modal fade" id="ls_live" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">LS Live</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
                <form action="#" id="form-lslive">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Validade</label>
                        <div class="col-sm-8">
                             <div class="input-group">
                                <input type="date" class="form-control hasDatepicker" placeholder="dd/mm/yyyy" name="lslive" id="lslive">
                                <i class="glyphicon glyphicon-calendar"></i>
                             </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" id="alter_save" onclick="alter_customer('form-lslive')">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="dados_acesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="modal-body">
             <div class="panel-body">

                <form id="form-customers" action="#">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" name="email" id="email_primario" class="form-control" placeholder="Digite seu e-mail..." required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Senha <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha..."  />
                            <!-- <small> (minimo 6 caracteres)</small> -->
                        </div>
                   </div>
                       
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" id="alter_save" onclick="alter_customer('form-customers')">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="dados_contato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
          
            <div class="panel-body">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-line nav-justified">
                <li class="active"><a href="#popular12" data-toggle="tab" aria-expanded="false"><strong>Telefones</strong></a></li>
                <li class=""><a href="#recent12" data-toggle="tab" aria-expanded="false"><strong>Emails</strong></a></li>
                
              </ul>

            </div>
                      
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="contentpanel">

        <div class="row profile-wrapper">
            <div class="col-xs-12 col-md-3 col-lg-2 profile-left">
                <div class="profile-left-heading">
                    <h2 class="profile-name nome"></h2>
                    <ul class="list-group">
                        <li class="list-group-item">CPF/CNPJ <div class="cpf_cnpj valor_destaque_lateral"></div></li>
                        <li class="list-group-item">NET <div class="net money valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Corretagem <div class="corretagem money valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Código XP <div class="codigo_origem_cliente_xp valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Data Nascimento <div class="data_nascimento valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Acessos<a data-toggle="modal" data-target="#dados_acesso" href="#"><i class="glyphicon glyphicon-pencil icon_alterar_login"></i></a></li>
                        <li class="list-group-item">LS Live<a data-toggle="modal" data-target="#ls_live" href="#" class="lslive"></a></li>
                    </ul>

                    <button class="btn btn-danger btn-quirk btn-block profile-btn-follow">Add. Comentário</button>
                </div>
                <div class="profile-left-body">
                    <h4 class="panel-title">Contatos 

                       <!--  <a data-toggle="modal" data-target="#dados_contato" href="#">
                        <i class="glyphicon glyphicon-pencil incon_alterar_contato"></i></a> -->

                    </h4>
                    <div class="contact-phone"></div>
                    
                    <div class="contact-email">

                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-10 profile-right">
                <div class="profile-right-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified nav-line">
                        <li class="active"><a href="#enderecos" data-toggle="tab"><strong>Endereços</strong></a></li>
                        <li><a href="#pedidos" data-toggle="tab"><strong>Pedidos</strong></a></li>
                        <li><a href="#historico" data-toggle="tab"><strong>Histórico</strong></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="enderecos">
                            <div class="row"></div>
                        </div>
                        <div class="tab-pane" id="pedidos">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTable1" class="table table-bordered table-striped-col">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Data/Hora</th>
                                                <th>Total</th>
                                                <th>Forma Pagamento</th>
                                                <th>Qtde. Itens</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Código</th>
                                                <th>Data/Hora</th>
                                                <th>Total</th>
                                                <th>Forma Pagamento</th>
                                                <th>Qtde. Itens</th>
                                            </tr>
                                            </tfoot>

                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="historico">
                            Histórico
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->

    </div><!-- contentpanel -->
@stop

@section('extra_styles')

@stop  

@section('extra_scripts')

    <script src="/assets/packages/datatables/jquery.dataTables.js"></script>
    <script src="/assets/packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="/assets/packages/select2/select2.js"></script>
    <script src="/assets/js/http.js"></script>
    <script src="/assets/js/form-to-json.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            'use strict';
            var iId = "{!! $id !!}";
            var options = {method:'GET', url:setUrl("clientes/" + iId), dados:null}
            ajaxRequest(options);
        });
        
        function alter_customer(value) 
        {
            var oNotification = new Notification();
            'use strict';
            var iId = "{!! $id !!}";
            var data = new Object();
            var url;
            var options = new Object();
            var request;

            data = $('#'+value).serializeFormJSON();
            
            lslive = moment(data.lslive);
            date_lslive = lslive.format("DD-MM-YYYY");
            
            url  = setUrl("clientes/atualizar_lslive/" + iId);
            options = {"url": url,"data": data};
            request = http.put(options);
           
            if(request.status == 200){
                oNotification.setResponse(request);
                oNotification.setUrl("/clientes/"+iId);
                oNotification.setSuccessMsg('Dados de acesso atualizados com sucesso.');
                oNotification.success();
                oNotification.render();
            }else{
               alert('Erro ao salvar a data do LSLive.');
            }
        }

        function ajaxRequest(options)
        {
            $.ajax({
                url         : options.url,
                dataType    : 'json',
                type        : options.method,
                success     : populate
    
            });

        }

        function populate(oJson)
        {
            var aTelefones      = [];
            var htmlTelefones   = '';
            var oTelefones      = oJson.telefones;
            var aEmails         = [];
            var oEmails         = oJson.emails;
            var htmlEmails      = '';
            var oEnderecos      = oJson.enderecos;
            var htmlEnderecos   = '';
            var oDataNascimento = oJson.data_nascimento;
            var oPedidos        = oJson.pedidos;
            var oLslive         = oJson.lslive;
            
            $(".nome").text( oJson.nome );
            $(".cpf_cnpj").text( oJson.cpf_cnpj).addClass("cpfCnpj");
            $(".net").text( oJson.net );
            $(".corretagem").text( oJson.corretagem );
            $(".codigo_origem_cliente_xp").text( oJson.codigo_origem_cliente_xp );
            $(".data_nascimento").text(oDataNascimento);
            $(".lslive").text(oLslive);
            
            /* TELEFONES */
            $.each(oTelefones, function (index, oTelefone) {
                aTelefones.push(oTelefone.telefone);
            });

            aTelefones = jQuery.unique( aTelefones );

            $.each(aTelefones, function(index, value) {
                htmlTelefones += '<p><i class="glyphicon glyphicon-phone mr5"></i><span class="phone">' + value + '</span></p>';
            });

            $(".contact-phone").html(htmlTelefones);

            /* EMAILS */
            $.each(oEmails, function (index, oEmail) {
                aEmails.push(oEmail.email);
            });

            aEmails = jQuery.unique( aEmails );

            htmlEmails += '<p><i class="glyphicon glyphicon-star mr5"></i><span>'+oJson.email+'</span></p>';

            $.each(aEmails, function(index, value) {
 
                htmlEmails += '<p><i class="glyphicon glyphicon-envelope mr5"></i><span>'+value+'</span></p>';
            });

            $(".contact-email").html(htmlEmails);

            /* ENDEREÇOS */
            $.each(oEnderecos, function (index, oEndereco)
            {
                htmlEnderecos += '<div class="col-md-6">';
                htmlEnderecos += '<address class="well">';
                htmlEnderecos += '<strong>' + oEndereco.logradouro + ', Nº. ' + oEndereco.numero  + '</strong><br>';
                htmlEnderecos += (oEndereco.complemento != '' ? oEndereco.complemento + ', ' : '');
                htmlEnderecos += (oEndereco.bairro != '' ? 'Bairro: ' + oEndereco.bairro : '');
                htmlEnderecos += (oEndereco.cidade != '' ? '<br>Cidade: ' + oEndereco.cidade + ' - ' : '');
                htmlEnderecos += (oEndereco.uf != '' ? 'Estado: <span class="upper">' + oEndereco.uf + '</span> - ' : '');
                htmlEnderecos += (oEndereco.pais != '' ? 'País: <span class="upper">' + oEndereco.pais + '</span>' : '');
                htmlEnderecos += (oEndereco.cep != '' ? '<br><strong>CEP: <span class="cep">' + oEndereco.cep + '</span></strong>' : '');
                htmlEnderecos += '</address>';
                htmlEnderecos += '</div>';
            });
            $("#enderecos > div.row").html(htmlEnderecos);


            /*ALTERAÇÃO DE EMAIL CADASTRAL*/
            $("#email_primario").val(oJson.email);

            /*LSLIVE MODAL*/
            $("#lslive").text(oLslive);
            
            /* PEDIDOS */
            var domain = window.location.hostname;
            var oTable = $('#dataTable1').DataTable();
            
            $.each(oPedidos, function(index, oObj)
            {
                var oDataHora = moment(oObj.created_at);
                var forma_pagamento;
                var data_hora = oDataHora.format("DD/MM/YYYY HH:mm");
                var qtde = oObj.produtos.length;
                
                if(oObj.pagamentos.length != 0)
                    forma_pagamento = oObj.pagamentos[0].metodo_pagamento.nome;
                else 
                    forma_pagamento = '-';
                
                oTable.row.add( [
                    '<a href="http://'+domain+'/pedidos/'+oObj.id+'">'+oObj.codigo_origem_pedido_hash+'</a>',
                    oObj.total,
                    data_hora,
                    forma_pagamento,
                    qtde
                ] ).draw();
            });
        }
    </script>
    
@stop