@extends('layouts.default')

@section('content')
    {{-- Content here --}}
    <div class="contentpanel">

        <div class="row">
            <div class="col-md-12 people-list">
                <div class="people-options clearfix sticky">
                    <div class="btn-toolbar pull-left">
                        <a href="/customer/create" class="btn btn-success btn-quirk">Novo Pedido</a>
                    </div>

                    <div class="searchpanel pull-left">
                        <span class="input-group-btn">
                            <div class="dropdown">
                            {!! Form::open(array('method' => "GET", 'url' => api_url('pedidos'), 'id' => 'searchForm')) !!}
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search_field" name="search_field" placeholder="Buscar...">
                                    <button type="button" class="btn btn-lg btn-default dropdown-toggle caret-busca-avancada" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <button id="btn-search" type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    <div class="dropdown-busca-avancada">
                                        <label><input type="radio" id="tipo_busca" name="tipo_busca" checked="checked" value="codigo_origem_pedido_hash"> Código</label>
                                        <label><input type="radio" id="tipo_busca" name="tipo_busca" value="cpf_cnpj"> CPF/CNPJ</label>
                                        <!-- <label><input type="radio" id="tipo_busca" name="tipo_busca" value="nome_produto"> Nome do Produto</label> -->
                                        <div style="clear:both"><a href="#" id="btn-busca-avancada" class="btn btn-success btn-quirk">Pesquisar</a></div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </span>
                    </div>

                    <div class="btn-group pull-right people-pager">
                        <button class="btn btn-default refresh"><i class="fa fa-refresh"></i></button>
                    </div>

                    <div class="btn-group pull-right people-pager">
                        <button type="button" class="btn btn-default btn-previous" data-previous="" disabled><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="btn btn-default btn-next"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <span class="people-count pull-right">Mostrando <strong class="count_showing"></strong> de <strong class="count_total"></strong></span>
                </div>
                
                <div id="msg_alert"></div>

                <div class="row">
                    {{--Content Model--}}
                    <div class="set-model-grid col-md-4 col-lg-3 hide" id="contentId_main">
                        <div class="nav-wrapper white">
                            <h5 class="sidebar-title">Código: <strong class="codigo_origem_pedido_hash"></strong></h5>
                            <ul class="nav nav-pills nav-stacked nav-quirk">
                                <li><a><i class="fa fa-sitemap"></i> <span>Categoria </span><span class="text-info-right categoria"></span></a></li>
                                <li><a><i class="fa fa-star"></i> <span>CPF/CNPJ </span><span class="text-info-right clientes"></span></a></li>
                                <li><a><i class="fa fa-calendar"></i> <span>Data / Hora </span><span class="text-info-right created_at"></span></a></li>
                                <li class="active"><a><i class="fa fa-star"></i> <span>Status </span><span class="text-info-right status_pedido_pagamento"></span></a></li>
                                <li><a><i class="fa fa-minus-circle"></i> <span>Desconto </span><span class="text-info-right descontos"></span></a></li>
                                <li><a><i class="fa fa-usd"></i> <span>Total Pedido </span><span class="text-info-right money total"></span></a></li>
                                <li class="nav-parent last">
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm view">Visualizar</button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm edit" disabled>Editar</button>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm delete" disabled>Deletar</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!-- col-sm-4 -->
                    {{--Content List--}}
                    <div id="contentList">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('extra_styles')

@stop

@section('extra_scripts')
    <script src="/assets/js/ContainerList.js"></script>

    <script type="text/javascript">
        atualUrl = setUrl("pedidos")+window.location.search;

        ajaxRequest( atualUrl, "GET", {} );

        $(".btn-previous").on("click",function()
        {
            var sUrl = $(this).attr("data-previous");
            var pUrl = sUrl.split('?');
            pUrl = pUrl[1];
            if(pUrl != '')
                history.pushState('','','/pedidos/?'+pUrl);        
            ajaxRequest( sUrl );
        });

        $(".btn-next").on("click",function()
        {
            var sUrl = $(this).attr("data-next");
            var pUrl = sUrl.split('?');
            pUrl = pUrl[1];
            if(pUrl != '')
                history.pushState('','','/pedidos/?'+pUrl);            
            ajaxRequest( sUrl );
        });
        
        $(".refresh").on("click", function()
        {
            $('#searchForm').resetForm();
            ajaxRequest( atualUrl );
        });

        $("#search_field").on("keyup", function() {
            var search_field = $("#search_field").val();
            var tipo_busca   = $('input[name=tipo_busca]:checked').val();
            if(tipo_busca == "codigo_origem_pedido_hash")
                search_field = formatarPesquisa(search_field);
            if (search_field == "")
                search_field = "0";
            
            var action       = setUrl('pedidos/searchAdvanced') + "/" + search_field + "/" + tipo_busca;
            $('#searchForm').attr("action",action);
        });
        
        $("#btn-search").on("click", function() {
            var search_field = $("#search_field").val();
            var tipo_busca   = $('input[name=tipo_busca]:checked').val();
            if(tipo_busca == "codigo_origem_pedido_hash")
                search_field = formatarPesquisa(search_field);
            if (search_field == "")
                search_field = "0";
            
            var action       = setUrl('pedidos/searchAdvanced') + "/" + search_field + "/" + tipo_busca;
            ajaxRequest( action );
        });
        
        $("#btn-busca-avancada").on("click",function()
        {
            var search_field = $("#search_field").val();
            var tipo_busca   = $('input[name=tipo_busca]:checked').val();
            if(tipo_busca == "codigo_origem_pedido_hash")
                search_field = formatarPesquisa(search_field);
            if (search_field == "")
                search_field = "0";
            
            var action       = setUrl('pedidos/searchAdvanced') + "/" + search_field + "/" + tipo_busca;
            ajaxRequest( action );
        });
        
        function formatarPesquisa(search) {
            return search.toLowerCase();
        }
        
        $('#searchForm').validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    crossDomain: true,
                    dataType: 'json',
                    success: function ( data )
                    {
                        var oList = new ContainerList( data );
                        oList.clear();
                        oList.setSelector( $('#contentId_main') );
                        oList.configPagination( data.meta );
                        oList.clone();
                        //$("ul.telefones li").find('a').addClass("phone");
                        $(".codigo_origem_pedido_hash").addClass("codigoOrigemPedidoHash");
                        $(".cpf_cnpj").addClass("cpfCnpj");
                    },
                });
            }
        });
        
        $(".view").livequery(function()
        {
            $(this).on("click", function() {
                var id = $(this).attr("data-id");
                $(location).attr('href', '/pedidos/' + id);
            });
        });

        function ajaxRequest( sUrl, sType, oData )
        {
            $.ajax({
                url         : sUrl,
                dataType    : 'json',
                type        : sType,
                data        : oData,
                success     : function( data ) {
                    var oList = new ContainerList( data );
                    oList.clear();
                    oList.setSelector( $('#contentId_main') );
                    oList.configPagination( data );
                    oList.clone();
                },
                error: function () {
                    $('#msg_alert').html('Sem permissão de acesso!');
                    $(location).attr('href', '/');
                }
            });
        }
    </script>
@stop