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
    buscaProfessores()
)

function buscaProfessores(){
    let dados = new FormData()
    dados.append('acao', 'buscaProfessores')
    $.ajax({
    url: '../site_etec/PHP/curso_crud.php',
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
            $('#prof_id').html(resposta.professores)
            
        }
    } )
    return
}

function Buscar(){
    let dados = new FormData()
    dados.append('acao', 'buscar')
    $.ajax({
    url: '../site_etec/PHP/curso_crud.php',
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
    let aux = confirm("Confirma a exclusão do curso?");
    if(!aux){
        return
    }
    let dados = new FormData()
    dados.append('acao', 'deletar')
    dados.append('curso', id)
    $.ajax({
    url: '../site_etec/PHP/curso_crud.php',
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

function Editar(id){
    let dados = new FormData()
    dados.append('acao', 'editar')
    dados.append('curso', id)
    $.ajax({
    url: '../site_etec/PHP/curso_crud.php',
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
            modal.style.display = "block";
            $('#curso_id').val(resposta.id)
            $('#nome').val(resposta.nome)
            $('#resumo').val(resposta.resumo)
            $('#requisitos').val(resposta.requisitos)
            $('#vagas').val(resposta.vagas)
            $('#periodo').val(resposta.periodo)
            $('#dias_semana').val(resposta.dias_semana)
            $('#tipo').val(resposta.tipo_curso)
            $('#msg_cadastro').text('')
        }
    } )
    return
}

$('#btn_abrir_cadastro').click(
    function () {
        $('#msg_cadastro').text('')
        $('#curso_id').val('')
        $('#nome').val('')
        $('#resumo').val('')
        $('#vagas').val('')
        $('#requisitos').val('')
        modal.style.display = "block";
        return
    }
)

$('#btn_salvar').click(
    function () {
        let dados = new FormData()
        dados.append('acao', 'salvar')
        dados.append('id', $('#curso_id').val())
        dados.append('nome', $('#nome').val())
        dados.append('professor', $('#prof_id').val())
        dados.append('vagas', $('#vagas').val())
        dados.append('resumo', $('#resumo').val())
        dados.append('requisitos', $('#requisitos').val())
        dados.append('periodo', $('#periodo').val())
        dados.append('tipo', $('#tipo').val())
        dados.append('dias_semana', $('#dias_semana').val())
        $.ajax({
        url: '../site_etec/PHP/curso_crud.php',
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