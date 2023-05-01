urlglobal = '';

usuarioId = getParameter('usuario');

// Carregar as matérias do professor(usuarioiId)
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaMaterias')
        dados.append('prof', getParameter('usuario'))
        $.ajax({
        url: '../site_etec/PHP/materias.php',
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
                $('#materias').html(resposta.materias)
            }
        } )
        return
    }
);

// Get the modal
var modal = document.getElementById("div_chamada");

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
function abrirDiv(){
    modal.style.display = "block";
    return;
}

function fechaChamada() {
    alert('Chamada Registrada')
    modal.style.display = "none";
    return;
}

function chamada(id_curso) {
    let dados = new FormData()
        dados.append('acao', 'carregaChamada')
        dados.append('id_curso', id_curso)
        $.ajax({
        url: '../site_etec/PHP/materias.php',
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
                $('#titulo').html(resposta.titulo)
                $('#lista').html(resposta.lista)
                abrirDiv()
            }
        } )
        return
}