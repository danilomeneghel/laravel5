$(document).ready(function () {
    var usuario_nome = Cookies.get('user_name');
    var usuario_tipo = Cookies.get('user_type');
    usuario_tipo = usuario_tipo.charAt(0).toUpperCase() + usuario_tipo.substr(1).toLowerCase();

    if (usuario_nome != "")
        $("#usuario").text(usuario_nome);

    if (usuario_nome != "")
        $("#usuario_nome").text(usuario_nome);

    if (usuario_tipo != "")
        $("#usuario_tipo").text(usuario_tipo);
});