ContainerList = function( obj ) {
    this.init( obj );
}

$.extend(ContainerList.prototype, {
    // object variables
    obj: '',
    selector: '',

    init: function( obj )
    {
        var oObj    = obj;
        if ( typeof oObj.length === "undefined" ) {
            oObj = obj.data;
        }

        $.each(oObj, function(i, oObj_i) {
            if (oObj_i.nome) {
                if (oObj_i.nome.length !== 0)
                    oObj_i.nome = oObj_i.nome;
            }
            
            if (oObj_i.preco) {
                if (oObj_i.preco.length !== 0)
                    oObj_i.preco = oObj_i.preco;
            }
        });
        this.obj = oObj;
    },
    setSelector: function( selector )
    {
        this.selector = selector;
    },
    clear: function()
    {
        //Clear #contentList
        $("#contentList").html("");
    },
    configPagination: function( oMeta )
    {
        if ( typeof oMeta === "undefined" ) {
            return false;
        }

        var oPagination    = oMeta.pagination;

        if ( typeof oPagination === "undefined" ) {
            oPagination = {
                "total": oMeta.total,
                "per_page": oMeta.per_page,
                "current_page": oMeta.current_page,
                "last_page": oMeta.last_page,
                "next_page_url": oMeta.next_page_url,
                "prev_page_url": oMeta.prev_page_url,
                "from": oMeta.from,
                "to": oMeta.to
            }
        }

        if ( $('.count_showing').length == 0 ) {
            console.log( "FALTANDO ELEMENTO .count_showing");
        } else {
            var iFimPagina      = (oPagination.current_page * oPagination.per_page);
            var iInicioPagina   = (iFimPagina - oPagination.per_page) + 1;
            $('.count_showing').text(iInicioPagina + '-' + iFimPagina);
        }

        if ( $('.count_total').length == 0 ) {
            console.log( "FALTANDO ELEMENTO .count_total");
        } else {
            $('.count_total').addClass("integer").text(oPagination.total);
        }

        if ($('.btn-previous').length == 0) {
            console.log("FALTANDO ELEMENTO .btn-previous");
        } else {
            if (typeof oPagination.links !== "undefined" && typeof oPagination.links.previous !== "undefined" && oPagination.links.previous != "") {
                $('.btn-previous').attr('data-previous', oPagination.links.previous).removeAttr("disabled");
            } else if ( typeof oPagination.prev_page_url !== "undefined" && typeof oPagination.prev_page_url !== "object" ) {
                $('.btn-previous').attr('data-previous', oPagination.prev_page_url).removeAttr("disabled");
            } else {
                $('.btn-previous').attr("disabled", "disabled");
            }
        }

        if ($('.btn-next').length == 0) {
            console.log("FALTANDO ELEMENTO .btn-next");
        } else {
            if (typeof oPagination.links !== "undefined" && typeof oPagination.links.next !== "undefined" && oPagination.links.next != "" ) {
                $('.btn-next').attr('data-next', oPagination.links.next).removeAttr("disabled");
            } else if ( typeof oPagination.next_page_url !== "undefined" && typeof oPagination.next_page_url !== "object" ) {
                $('.btn-next').attr('data-next', oPagination.next_page_url).removeAttr("disabled");
            } else {
                $('.btn-next').attr("disabled", "disabled");
            }
        }
    },
    clone: function()
    {
        var $this = this.selector;
        /**
         * Percorre o objeto pulando sempre o elemento 0, que é a base do clone.
         */
        $.each(this.obj, function(i,object) {

            var clone   = '';
            var elementId = '';

            clone = $this.clone();
            elementId = clone.attr("id", "contentId_" + i);
            clone.removeClass("hide");
            $.each(object, function(key, value){

                if ( typeof value === "string" ) {
                    if (value.indexOf("|") > 0) {
                        var a = value.split("|");
                        var list = '';
                        $.each(a, function (i, el) {
                            if( el != '' ) {
                                list += '<li><a href="">' + el + '</a></li>';
                            }
                        });
                        value = list;
                    }
                }

                /* Elements */
                elementId.find('.'+key).html(value);
            });
            /* Buttons */
            elementId.find('.last').children().find("button").attr("data-id",object.id);
            elementId.find(".active > ul").css("display","none");
            $("#contentList").append(elementId);
        });
    },
    destroy: function()
    {
        $("#contentList").html("");
    }

});