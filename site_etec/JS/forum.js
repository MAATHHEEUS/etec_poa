// Get the modais
var modalResposta = document.getElementById("div_resposta");
var modalPergunta = document.getElementById("div_pergunta");

// Get the <span> elements that closes the modal
var spanResposta = document.getElementsByClassName("close")[0];
var spanPergunta = document.getElementsByClassName("close")[1];

// When the user clicks on <span> (x), close the modal de Resposta
spanResposta.onclick = function() {
    modalResposta.style.display = "none";
    return;
}
// When the user clicks on <span> (x), close the modal de Pergunta
spanPergunta.onclick = function () {
    modalPergunta.style.display = "none";
    return;
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalResposta) {
        modalResposta.style.display = "none";
        return;
    }
    if (event.target == modalPergunta){
        modalPergunta.style.display = "none";
        return;
    }
}

// Carregar as últimas dúvidas
$(document).ready(
    Buscar()
)

function Buscar(){
    let dados = new FormData()
    dados.append('acao', 'buscar')
    dados.append('conteudo', $('#conteudo').val())
    $.ajax({
    url: '../PHP/forum.php',
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
            $('#interacoes').html(resposta.interacoes)
            if(resposta.interacoes === ''){
                document.getElementById('btn_ask').removeAttribute('hidden')
            }
        }
    } )
    return
}

function responder(id_pergunta){
    // Show div de resposta
    let dados = new FormData()
    dados.append('acao', 'dadosPergunta')
    dados.append('id_pergunta', id_pergunta)
    $.ajax({
    url: '../PHP/forum.php',
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
            $('#pergunta').html(resposta.pergunta)
            modalResposta.style.display = "block";
            $('#descricao_pergunta').val(resposta.descricao)
            $('#id_pergunta').val(id_pergunta)
        }
    } )
    return
}

$('#btn_responder').click(
    function(){
        if($('#descricao_resposta').val() === '' || $('#autor_resposta').val() === ''){
            alert('Digite os dados para responder!')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'responder')
        dados.append('id_pergunta' , $('#id_pergunta').val())
        dados.append('descricao', $('#descricao_resposta').val())
        dados.append('autor', $('#autor_resposta').val())
        $.ajax({
            url: '../PHP/forum.php',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json'
            }).done(function(resposta){
                if(resposta.tipo === 'E'){
                    alert(resposta.msg)
                }
                $('#msg_resposta').text(resposta.msg)
                if(resposta.tipo === 'OK'){
                    $('#descricao_resposta').val('')
                    $('#autor_resposta').val('')
                }
            } 
        )
        return
    }
)

$('#btn_abrirPergunta').click(
    function () {
        modalPergunta.style.display = "block";
        return
    }
)

$('#btn_postar').click(
    function(){
        if($('#descricao').val() === '' || $('#autor').val() === ''){
            alert('Digite os dados para registrar sua idéia!')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'perguntar')
        dados.append('descricao', $('#descricao').val())
        dados.append('autor', $('#autor').val())
        $.ajax({
            url: '../PHP/forum.php',
            method: 'post',
            data: dados,
            processData: false,
            contentType: false,
            dataType: 'json'
            }).done(function(resposta){
                if(resposta.tipo === 'E'){
                    alert(resposta.msg)
                }
                $('#msg_pergunta').text(resposta.msg)
                if(resposta.tipo === 'OK'){
                    $('#descricao').val('')
                    $('#autor').val('')
                }
            } 
        )
        return        
    }
)