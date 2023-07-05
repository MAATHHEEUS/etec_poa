// Ação de cadastrar um campo 
$('#btn_cadastro').click(
    function(){
        if($('#nome_cadastro').val() === '' || $('#endereco_cadastro').val() === ''){
            alert('Todos os campos são obrigatórios!')
            return;
        }
        let dados = new FormData()
        dados.append('acao', 'salvar')
        dados.append('nome', $('#nome_cadastro').val())
        dados.append('endereco', $('#endereco_cadastro').val())
        $.ajax({
        url: 'main-campo.php',
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
            $('#nome_cadastro').val('')
            $('#endereco_cadastro').val('')
        } )
        return
    }
)

// Ação de pesquisar um campo
function consultar(codigo = ''){
    let dados = new FormData()
    dados.append('acao', 'consultar')
    if(codigo === ''){
        dados.append('codigo', $('#codigo').val())
    }
    else{
        dados.append('nome', codigo)
    }
    $.ajax({
    url: 'main-campo.php',
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
            $('#id_campo_consulta').val(resposta.id)
            $('#nome_consulta').val(resposta.nome)
            $('#endereco_consulta').val(resposta.endereco)
            document.getElementById('grid').setAttribute("hidden", "")
            document.getElementById('editar').removeAttribute("hidden")
            document.getElementById('btn_salvar').removeAttribute("hidden") 
            document.getElementById('btn_deletar').removeAttribute("hidden")
        }
    } )
    return
}

function pegar(){
    let dados = new FormData()
    dados.append('acao', 'pegar')
    $.ajax({
        url: 'main-campo.php',
        method: 'post',
        data: dados,
        processData: false,
        contentType: false,
        dataType: 'json'
        }).done(function(resposta){
            if(resposta.tipo === 'E'){
                alert(resposta.msg)
                document.getElementById('grid').setAttribute("hidden", "") 
            }
            $('#msg').text(resposta.msg)
            if(resposta.tipo === 'OK'){
                document.getElementById('grid').removeAttribute("hidden")
                $('#grid').html(resposta.grid)
                document.getElementById('editar').setAttribute("hidden", "")  
                
            }
        } )
        return
}

// Ação de excluir um campo

$('#btn_deletar').click(
    function () {
        $aux = confirm('EXCLUIR CAMPO?')
        if(!$aux){
            return
        }
        let dados = new FormData()
        dados.append('acao', 'excluir')
        dados.append('id', $('#id_campo_consulta').val())
        $.ajax({
        url: 'main-campo.php',
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
            pegar()
            pegar();
            document.getElementById('editar').setAttribute("hidden", "")
            $('#codigo').val('')
        } )
        return
    }
)

// Ação de atualizar um campo
$('#btn_salvar').click(
    function(){
        if($('#nome_consulta').val() === '' || $('#endereco_consulta').val() === ''){
            alert('Todos os campos são obrigatórios!')
            return;
        }
        let dados = new FormData()
        dados.append('acao', 'atualizar')
        dados.append('id_campo', $('#id_campo_consulta').val())
        dados.append('nome', $('#nome_consulta').val())
        dados.append('endereco', $('#endereco_consulta').val())
        $.ajax({
        url: 'main-campo.php',
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
            pegar();
            document.getElementById('editar').setAttribute("hidden", "")
            $('#codigo').val('')
        } )
        return
    }
)

// Botões de abas superior
$('#btn_para_consulta').click(function(){
    // Sempre volta ao estado inicial ao entrar no form
    document.getElementById('editar').setAttribute("hidden", "")
    $('#codigo').val('')

    // Mostra o form de consulta e esconde os outros
    document.getElementById('consulta').removeAttribute("hidden")
    document.getElementById('cadastro').setAttribute("hidden", "")
    $('#titulo').text('CONSULTA DE CAMPOS')
    pegar()
    limpar_Msg()
    return
})

$('#btn_para_cadastro').click(function(){
    // Sempre volta ao estado inicial ao entrar no form
    $('#nome_cadastro').val('')
    $('#endereco_cadastro').val('')

    // Mostra o form de cadastro e esconde os outros
    document.getElementById('cadastro').removeAttribute("hidden")
    document.getElementById('consulta').setAttribute("hidden", "")
    $('#titulo').text('CADASTRO DE CAMPOS')
    limpar_Msg();
    return
})

// Função para limpar a mensagem
function limpar_Msg() {
    $('#msg').text('')
    return
}