// Carregar as últimas notícias
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaNoticias')
        if(getParameter('tipo') !== ''){
            dados.append('tipo_usuario', getParameter('tipo'))
        }
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
                showSlides(slideIndex);
            }
        } )
        return
    }
);

var usuarioId = getParameter('usuario')
var slideIndex = 1;

if(Number(usuarioId) > 0){
    $('#caixa2').hide();
}

function plusDivs(n) {
    slideIndex += n
    showSlides(slideIndex);
}

function showSlides(n) {
    let slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}