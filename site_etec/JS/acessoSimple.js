$('#btn_enviar').click(
    function () {
        if($('#email').val() === '' || $('#senha').val() === ''){
            alert('Dados não digitados corretamente!')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'checaLogin')
        dados.append('email', $('#email').val())
        dados.append('senha', $('#senha').val())
        $.ajax({
        url: '../site_etec/PHP/acessoSimple.php',
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
                if($('#senha').val() === '00000'){
                    alert(resposta.msg)
                    document.getElementById('cadSenha').removeAttribute('hidden')
                    return
                }
                var encrypted = CryptoJS.AES.encrypt('usuario='+resposta.usuarioId+'&tipo='+resposta.tipo_usr, "aes-128-gcm");
                while(String(encrypted).includes('+') || String(encrypted).includes('&')){
                    var encrypted = CryptoJS.AES.encrypt('usuario='+resposta.usuarioId+'&tipo='+resposta.tipo_usr, "aes-128-gcm");
                }
                open('http://etecpoa.great-site.net/?sessao='+encrypted, '_self')
            }
        } )
        return
    }
)

$('#btn_cadsenha').click(
    function () {
        if($('#novaSenha').val() === '' || $('#novaSenha').val() === '00000'){
            alert('Sua nova senha não pode ser vazia nem 00000!')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'cadSenha')
        dados.append('email', $('#email').val())
        dados.append('senha', $('#novaSenha').val())
        $.ajax({
        url: '../site_etec/PHP/acessoSimple.php',
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
                document.getElementById('cadSenha').setAttribute('hidden', '')
                $('#senha').val('')
            }
        } )
        return
    }
)

function onMouseOver(element) {
    element.style.color = 'lavender';
    element.style.background = 'indigo';
}

function onMouseOut(element) {
    element.style.color = 'indigo';
    element.style.background = 'lavender';
}