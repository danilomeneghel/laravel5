@extends('layouts.default')

@section('content')
    {{-- Content here --}}
    <div class="contentpanel">

        <div class="row">
            <div class="col-md-12 people-list">
                <div class="people-options clearfix sticky">
                    <div class="btn-toolbar pull-left">
                        <a href="/clientes/create" class="btn btn-success btn-quirk">Novo Cliente</a>
                    </div>

                    <div class="searchpanel pull-left">
                        {!! Form::open(array('method' => "GET", 'url' => api_url('clientes'), 'id' => 'searchForm')) !!}
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_field" name="search_field" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button id="btn-search" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        {!! Form::close() !!}
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
                            <h5 class="sidebar-title nome"></h5>
                            <ul class="nav nav-pills nav-stacked nav-quirk">
                                <li><a><i class="fa fa-star"></i> <span>CPF/CNPJ: </span><span class="span-right cpf_cnpj"></span></a></li>
                                <li class="nav-parent active">
                                    <a href=""><i class="fa fa-phone"></i> <span>Telefones</span></a>
                                    <ul class="children telefones">
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href=""><i class="fa fa-envelope"></i> <span>Emails</span></a>
                                    <ul class="principal children email">
                                    </ul>
                                    <ul class="children emails">
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a href=""><i class="fa fa-usd"></i> <span>Investimentos</span> <span class="span-right codigo_origem_cliente_xp mr20"></span><span class="span-right mr5">Cód. XP </span></a>
                                    <ul class="children">
                                        <li><a href="">NET: <span class="net span-right money mt5 mr20"></span></a></li>
                                        <li><a href="">Corretagem: <span class="corretagem span-right money mt5 mr20"></span></a></li>
                                    </ul>
                                </li>
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
        atualUrl = setUrl("clientes")+window.location.search;

        ajaxRequest( atualUrl, "GET", {} );

        $(".btn-previous").on("click",function()
        {
            var sUrl = $(this).attr("data-previous");
            var pUrl = sUrl.split('?');
            pUrl = pUrl[1];
            if(pUrl != '')
                history.pushState('','','/clientes/?'+pUrl);        
            ajaxRequest( sUrl );
        });

        $(".btn-next").on("click",function()
        {
            var sUrl = $(this).attr("data-next");
            var pUrl = sUrl.split('?');
            pUrl = pUrl[1];
            if(pUrl != '')
                history.pushState('','','/clientes/?'+pUrl);            
            ajaxRequest( sUrl );
        });

        $(".refresh").on("click", function()
        {
            $('#searchForm').resetForm();
            ajaxRequest( atualUrl );
        });
        
        $("#search_field").on("keyup", function() {
            var search_field = $("#search_field").val();
            var action       = setUrl('clientes/search') + "/" + search_field;
            $('#searchForm').attr("action",action);
        });

        $("#btn-search").on("click", function() {
            var search_field = $("#search_field").val();
            var action       = setUrl('clientes/search') + "/" + search_field;
            $('#searchForm').attr("action",action);
            ajaxRequest( action );
        });

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
                        $("ul.telefones li").find('a').addClass("phone");
                        $(".cpf_cnpj").addClass("cpfCnpj");
                    },
                });
            }
        });

        $(".view").livequery(function()
        {
            $(this).on("click", function() {
                var id = $(this).attr("data-id");
                $(location).attr('href', '/clientes/' + id);
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
                    oList.configPagination( data.meta );
                    oList.clone();
                    $("ul.telefones li").find('a').addClass("phone");
                    $(".cpf_cnpj").addClass("cpfCnpj");
                },
                error: function () {
                    $('#msg_alert').html('Sem permissão de acesso!');
                    $(location).attr('href', '/');
                }
            });
        }
    </script>
@stop