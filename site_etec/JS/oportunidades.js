// Get the modal
var modal = document.getElementById("caixa1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btn-close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  return;
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    return;
  }
  return;
}

// Show div
function abrirDiv(id_oportunidade){
    let dados = new FormData()
    dados.append('acao', 'dadosOportunidade')
    dados.append('id_oportunidade', id_oportunidade)
    $.ajax({
    url: '../site_etec/PHP/oportunidades.php',
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
            $('#nome_oportunidade').html(resposta.nome)
            $('#resumo').html(resposta.resumo)
            $('#requisitos').html(resposta.requisitos)
            $('#contato').val(resposta.contato)
            $('#empresa').val(resposta.empresa)
            $('#area').val(resposta.area)
            $('#link').html(resposta.link)
            modal.style.display = "block";
        }
    } )
    return
}

// Carregar a grid de estágios
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaOportunidades')
        $.ajax({
        url: '../site_etec/PHP/oportunidades.php',
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
                $('#grid').html(resposta.grid)
            }
        } )
        return
    }
);