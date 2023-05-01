// Carregar as últimas notícias
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaNoticias')
        $.ajax({
        url: '../site_etec/PHP/principal.php',
        method: 'post',
        data: dados,
        processData: false,
        contentType: false,
        dataType: 'json'
        }).done(function(resposta){
            if(resposta.tipo === 'E'){
                alert(resposta.msg)
            }
            $('#msg').text(resposta.msg)
            if(resposta.tipo === 'OK'){
                $('#noticias').html(resposta.noticias)
            }
        } )
        return
    }
);

var usuarioId = getParameter('usuario')

if(usuarioId > 0){
    $('#caixa2').hide();
}