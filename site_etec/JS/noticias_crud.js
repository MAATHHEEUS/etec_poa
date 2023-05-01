// Get the modais
var modal = document.getElementById("div_cadastro");

// Get the <span> elements that closes the modal
var span = document.getElementsByClassName("btn-close")[0];

// When the user clicks on <span> (x), close the modal de Resposta
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
}

// Carregar as últimas dúvidas
$(document).ready(
    Buscar(),
)

function Buscar(){
    let dados = new FormData()
    dados.append('acao', 'buscar')
    $.ajax({
    url: '../site_etec/PHP/noticia_crud.php',
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

function Deletar(id){
    let aux = confirm("Confirma a exclusão da notícia?");
    if(!aux){
        return
    }
    let dados = new FormData()
    dados.append('acao', 'deletar')
    dados.append('noticia', id)
    $.ajax({
    url: '../site_etec/PHP/noticia_crud.php',
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
            Buscar()
        }
    } )
    return
}

$('#btn_abrir_cadastro').click(
    function () {
        $('#msg_cadastro').text('')
        $('#noticia_id').val('')
        $('#titulo').val('')
        $('#descricao').val('')
        $('#imagem').val('')
        modal.style.display = "block";
        return
    }
)

$('#btn_salvar').click(
    function () {
        let extensao = $('input#imagem').val().split('.').pop();
        if(!verificaExtensaoImgem(extensao)){
            alert('Arquivo não suportado, somente arquivos .png/.jpeg/.jfif/.jpg!')
            return
        }

        if($('#titulo').val() === '' || $('#descricao').val() === '' || $('input#imagem')[0].files[0] === null){
            alert('Preencha todos os campos e carregue uma imagem!');
            return;
        }
        let dados = new FormData()
        dados.append('acao', 'salvar')
        dados.append('titulo', $('#titulo').val())
        dados.append('descricao', $('#descricao').val())
        dados.append('imagem', $('input#imagem')[0].files[0])
        $.ajax({
        url: '../site_etec/PHP/noticia_crud.php',
        method: 'post',
        data: dados,
        processData: false,
        contentType: false,
        dataType: 'json'
        }).done(function(resposta){
            if(resposta.tipo === 'E'){
                alert(resposta.msg)
            }
            $('#msg_cadastro').text(resposta.msg)
            if(resposta.tipo === 'OK'){
                Buscar()
                modal.style.display = "none";
                alert(resposta.msg)
            }
        } )
        return
    }
)

function verificaExtensaoImgem(extensao){
    switch(extensao){
        case 'png':
            return true;
        
        case 'jpeg':
            return true;

        case 'jfif':
            return true;

        case 'jpg':
            return true;

        default:
            return false;
    }
}