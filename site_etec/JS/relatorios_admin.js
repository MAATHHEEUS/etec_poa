usuarioId = getParameter('usuario');

// Carregar as matérias do professor(usuarioId)
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaCursos')
        $.ajax({
        url: '../site_etec/PHP/relatorios_admin.php',
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
                $('#cursos_rel_admin').html(resposta.cursos)
            }
        } )
        return
    }
);

function print(dec){
    open("../site_etec/PHP/fpdf." + dec + ".php?usuario=" + usuarioId+"&periodo="+document.getElementById("periodo").value+"&curso="+document.getElementById("cursos_rel_admin").value, "_blank")
    return
}