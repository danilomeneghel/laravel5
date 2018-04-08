@extends('layouts.default')

@section('content')
    {{-- Content here --}}
    <div class="contentpanel">

        <div class="row profile-wrapper">
            <div class="col-xs-12 col-md-3 col-lg-2 profile-left">
                <div class="profile-left-heading">
                    <h2 class="profile-name id"></h2>
                    <ul class="list-group">
                        <li class="list-group-item">Nome <a href="" class="link_cliente"><div class="nome valor_destaque_lateral"></div></a></li>
                        <li class="list-group-item">CPF / CNPJ <div class="cpf_cnpj valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Data / Hora <div class="created_at valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Status <div class="status_pedido_pagamento valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Descontos <div class="descontos valor_destaque_lateral"></div></li>
                        <li class="list-group-item">Total <div class="total formatMoney valor_destaque_lateral"></div></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-lg-10 profile-right">
                <div class="profile-right-body">
                    <div class="panel">
                        <div class="panel-body">
                            <div id="info_pedido">
                                <h4 class="panel-title mb10">Informações do Pedido</h4>
                                <table id="tableProdutosPedido" class="table table-bordered table-striped-col">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantidade</th>
                                            <th>Preço</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                            </div>
                            <hr>
                            <div id="pagamento">
                                <h4 class="panel-title mb10">Pagamento</h4>
                                <ul class="list-group hide">
                                    <li class="list-group-item">Gateway <a href="#" class="right gateway"></a></li>
                                    <li class="list-group-item">Tipo de pagamento <a href="#" class="right tipo_pagamento"></a></li>
                                    <li class="list-group-item">ID da transação <a href="#" class="right id_transacao"></a></li>
                                    <li class="list-group-item">Quantidade de parcelas <a href="#" class="right qtde_parcelas"></a></li>
                                    <li class="list-group-item">Total do pagamento <a href="#" class="right total_pagamento money"></a></li>
                                </ul>
                                <p class="hide">N/A</p>
                            </div>

                            <hr>
                            <div id="status">
                                <h4 class="panel-title mb10">Status</h4>
                                <ul class="list-group">

                                </ul>
                            </div>

                            <hr>
                            <div id="endereco_entrega">
                                <h4 class="panel-title mb10">Endereço de entrega</h4>
                                <div class="content"></div>
                            </div>
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

    <script type="text/javascript">

        var $this = this;
        var domain = window.location.hostname;
        
        $(document).ready(function() {
            'use strict';

            var iId = "{!! $id !!}";
            ajaxRequest(setUrl("pedidos/" + iId));

            $('.formatMoney').livequery(function(){
                $(this).priceFormat({
                    prefix: 'R$ ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
            })
        });

        function ajaxRequest( sUrl )
        {
            $.ajax({
                url         : sUrl,
                dataType    : 'json',
                type        : "GET",
                success     : populate
            });
        }

        function populate(oJson)
        {
            dadosPrincipais(oJson);
            informacoesPedido(oJson);
            pagamentos(oJson);
            status(oJson);
            endereco(oJson);
        }

        function dadosPrincipais(oJson)
        {
            var oDate = moment(oJson.created_at);

            $(".id").text("Pedido " + oJson.codigo_origem_pedido_hash);
            $(".created_at").text(oDate.format("DD/MM/YYYY HH:mm"));

            if ( oJson.status_pedido_pagamento ) {
                $(".status_pedido_pagamento").text(oJson.status_pedido_pagamento[0].status.nome);
            }
            
            if ( oJson.clientes ) {
                $(".nome").text(oJson.clientes.nome);
                $(".cpf_cnpj").text(oJson.clientes.cpf_cnpj);
                $(".link_cliente").attr("href", "http://"+domain+"/clientes/"+oJson.clientes.id);
            }

            if ( oJson.descontos ) {
                var sDesconto = '';
                var iDescontoInteiro = 0;
                var iDescontoPorcentagem = 0;
                $.each(oJson.descontos, function (im, oDesconto) {
                    switch (oDesconto.proporcao) {
                        case 'inteiro':
                            iDescontoInteiro += parseInt(oDesconto.desconto);
                            break;
                        case 'porcentagem':
                            iDescontoPorcentagem += parseInt(oDesconto.desconto);
                            break;
                    }
                });

                if (iDescontoInteiro > 0) {
                    sDesconto = 'R$ ' + iDescontoInteiro;
                } else if (iDescontoPorcentagem > 0) {
                    sDesconto = ' ' + iDescontoPorcentagem + '%';
                }
                $(".descontos").text(sDesconto);
            }

            $(".total").text(oJson.total);
        }

        function informacoesPedido(oJson)
        {
            var sHtml       = '';
            var subTotal    = 0;
            var cupom       = '-';
            $.each(oJson.produtos, function(index, oObj)
            {
                var sub_total = math.multiply(oObj.quantidade, oObj.preco);
                sub_total = parseFloat(Math.round(sub_total * 100) / 100).toFixed(2);
                subTotal += parseFloat(sub_total);
                sHtml += '<tr>';
                sHtml += '<td>' + oObj.produto.nome + '</td>';
                sHtml += '<td>' + oObj.quantidade + '</td>';
                sHtml += '<td class="text-right formatMoney">' + oObj.preco + '</td>';
                sHtml += '<td class="text-right formatMoney">' + sub_total + '</td>';
                sHtml += '</tr>';
            });

            $.each(oJson.descontos, function (im, oDesconto) {
                if( oDesconto.tipo == 'cupom') {
                    cupom = "-" + oDesconto.desconto + "% (" + oDesconto.nome + ")";
                }
            });

            var desconto = parseFloat(Math.round(oJson.sub_total * 100) / 100).toFixed(2) - parseFloat(Math.round(oJson.total * 100) / 100).toFixed(2);
            
            /** Subtotal */
            sHtml += '<tr>';
            sHtml += '<td colspan="2" class="text-right bold">Sub Total</td>';
            sHtml += '<td colspan="2" class="text-center formatMoney">' + parseFloat(Math.round(oJson.sub_total * 100) / 100).toFixed(2); + '</td>';
            sHtml += '</tr>';
            /** Cupom */
            sHtml += '<tr>';
            sHtml += '<td colspan="2" class="text-right bold">Cupom</td>';
            sHtml += '<td colspan="2" class="text-center upper">' + cupom + '</td>';
            sHtml += '</tr>';
            /** Desconto */
            sHtml += '<tr>';
            sHtml += '<td colspan="2" class="text-right bold">Desconto</td>';
            sHtml += '<td colspan="2" class="text-center formatMoney">' + parseFloat(Math.round(desconto * 100) / 100).toFixed(2) + '</td>';
            sHtml += '</tr>';
            /** Total */
            sHtml += '<tr>';
            sHtml += '<td colspan="2" class="text-right bold">Total</td>';
            sHtml += '<td colspan="2" class="text-center formatMoney">' + parseFloat(Math.round(oJson.total * 100) / 100).toFixed(2) + '</td>';
            sHtml += '</tr>';
            $("#tableProdutosPedido tbody").html(sHtml);
        }

        function pagamentos(oJson)
        {
            $("#pagamento ul.list-group").addClass('hide');
            $("#pagamento p").addClass('hide');

            if ( $.isEmptyObject(oJson.pagamentos) ) {
                $("#pagamento p").removeClass('hide');
            } else {
                $("#pagamento ul.list-group").removeClass('hide');
                $.each(oJson.pagamentos, function(index, oPagamento) {
                    $(".gateway").text('Braspag');
                    $(".tipo_pagamento").text(oPagamento.metodo_pagamento.nome);
                    $(".id_transacao").text(oPagamento.transaction_hash);
                    $(".qtde_parcelas").text(oPagamento.qtde_parcelas);
                    $(".total_pagamento").text(oJson.total);
                });
            }
        }

        function status(oJson)
        {
            var sHtml = '';
            $.each(oJson.status_pedido_pagamento, function(index, oStatusPedidoPagamento) {
                statusPedido = formatarNome(oStatusPedidoPagamento.status.nome);
                sHtml += '<li class="list-group-item">' + statusPedido + ' <div class="right valor_destaque">' + moment(oStatusPedidoPagamento.created_at).format("DD/MM/YYYY HH:mm") + '</div></li>';
            });
            $("#status ul").html("").html(sHtml);
        }

        function formatarNome(nome) {
            nome = nome.replace('_',' ');
            str = nome.replace(/\b[a-z]/g, function (firstLetter) {
                return firstLetter.toUpperCase();
            });
            return str;
        }
        
        function endereco(oJson)
        {
            var htmlEnderecos   = '';
            if($.isEmptyObject(oJson.enderecos)) {
                htmlEnderecos = 'N/A';
            } else {
                $.each(oJson.enderecos, function (index, oEndereco) {
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
            }
            $("#endereco_entrega .content").html("").html(htmlEnderecos);
        }
    </script>
@stop