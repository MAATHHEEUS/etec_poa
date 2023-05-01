usuarioId = getParameter('usuario');

// Carregar as matérias do professor(usuarioId)
$(document).ready(
    function() {
        let dados = new FormData()
        dados.append('acao', 'carregaMaterias')
        dados.append('prof', getParameter('usuario'))
        $.ajax({
        url: '../site_etec/PHP/relatorios_prof.php',
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

function print(dec){
    open("../site_etec/PHP/fpdf." + dec + ".php?usuario=" + usuarioId+"&materia="+document.getElementById("materias").value, "_blank")
    return
}