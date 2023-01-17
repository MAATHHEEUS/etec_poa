// Carregar as últimas notícias
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaNoticias')
        $.ajax({
        url: '../PHP/principal.php',
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