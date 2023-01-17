$('#btn_enviar').click(
    function () {
        if($('#descricao').val() === ''){
            alert('Digite algo para nos ajudar a melhorar.')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'salvar')
        dados.append('descricao', $('#descricao').val())
        $.ajax({
        url: '../PHP/denuncias.php',
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