$(document).ready(function() {

    $("#btnLogout").on("click", function (e) {
        e.preventDefault();
        Cookies.remove('access_token');
        Cookies.remove('refresh_token');
        Cookies.remove('user_name');
        Cookies.remove('user_type');
        $(location).attr('href', '/');
    });

    /* MEIO MASK */
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.integer').mask('999.999.999.999', {reverse: true});

    var optionsPhone = {
        onKeyPress: function(phone, ev, el, op){
            var masks = ['(00) 00000-0000', '(00) 0000-00000'],
                mask = (phone.replace(/\D/g, '').length === 11) ? masks[1] : masks[0];
            el.mask(mask, op);
        }
    };
    $('.phone').mask('(00) 0000-00000', optionsPhone);

    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.uf').mask('AA', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    var optionsCpfCnpj = {
        onKeyPress: function(cpf, ev, el, op){
            if(cpf.length>12) console.log(cpf.length);
            var masks = ['000.000.000-000', '00.000.000/0000-00'],
                mask = (cpf.length>14) ? masks[1] : masks[0];
            el.mask(mask, op);
        }
    }
    $('.cpfCnpj').mask('000.000.000-000', optionsCpfCnpj);
});