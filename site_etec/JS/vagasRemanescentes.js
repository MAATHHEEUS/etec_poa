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

// Variaveis para alimentar o botão de inscrever
var curso
var id_curso

function abrirInscricao() {
    loadPag('principal', '../site_etec/HTML/formInscricao.html?curso='+curso+'&id_curso='+id_curso)
}

// Show div
function abrirDiv(id){
    let dados = new FormData()
    dados.append('acao', 'dadosCurso')
    dados.append('id_curso', id)
    $.ajax({
    url: '../site_etec/PHP/vagasRemanescentes.php',
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
            $('#nome_curso').html(resposta.nome_curso)
            $('#resumo').html(resposta.resumo)
            $('#requisitos').html(resposta.requisitos)
            $('#periodo').val(resposta.periodo)
            $('#diassemana').val(resposta.diassemana)
            $('#tipo').val(resposta.tipo_curso)
            curso = resposta.curso
            id_curso = resposta.id_curso
            modal.style.display = "block";
        }
    } )
    return
}

// Carregar a grid de vagas
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaVagas')
        $.ajax({
        url: '../site_etec/PHP/vagasRemanescentes.php',
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
