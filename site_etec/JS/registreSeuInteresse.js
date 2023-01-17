// Get the modal
var modal = document.getElementById("caixa1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

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

$('#btn_enviar').click(
    function () {
        alert(window.location.search)
        var politicas = document.getElementById("politicas");
        if(!politicas.checked){
            alert('Aceite as Politícas e Termos de Privacidade!')
            return;
        }
        if($('#ddd1').val() === '' || $('#telefone1').val() === ''){
            alert('Preencha ao menos um Número de contato!')
            return
        }
        if($('#nome').val() === '' || $('#email').val() === ''){
            alert('Preencha o nome e e-mail corretamente!')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'registrar')
        dados.append('nome', $('#nome').val())
        dados.append('email', $('#email').val())
        dados.append('ddd', $('#ddd1').val())
        dados.append('telefone', $('#numero1').val())
        dados.append('periodo', $('#periodo').val())
        dados.append('diassemana', $('#diassemana').val())
        $.ajax({
        url: '../PHP/registreSeuInteresse.php',
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
                $('#nome').val('')
                $('#email').val('')
                $('#ddd1').val('')
                $('#numero1').val('')
                $('#ddd2').val('')
                $('#numero2').val('')
            }
        } )
        return
    }
)
var nome_curso = getParameter('nome_curso')

$('#nome_curso').html('<h4>Curso: '+nome_curso+'</h4>')

if(nome_curso === 'EMT'){
    $('#diassemana').html('<option value="1">Seg. a Sex.</option>')
}