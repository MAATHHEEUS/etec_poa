$('#btn_enviar').click(
    function () {
        var politicas = document.getElementById("politicas");
        if(!politicas.checked){
            alert('Aceite o Termo de Respeito à Instituição!')
            return;
        }
        if($('#descricao').val() === ''){
            alert('Digite algo para nos ajudar a melhorar.')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'salvar')
        dados.append('descricao', $('#descricao').val())
        $.ajax({
        url: '../site_etec/PHP/denuncias.php',
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
                alert(resposta.msg)
                $('#descricao').val('')
            }
        } )
        return
    }
)

// Get the modal
var modal = document.getElementById("caixa2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btn-close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  return;
}

function fecharPoliticas() {
  modal.style.display = "none";
  return;
}

// Show div
function abrirDiv(){
    modal.style.display = "block";
    return;
}