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

$('#btn_cpf').click(
    function () {
        if($('#cpf').val() === '' || Number($('#cpf').val()) === NaN){
            alert('CPF deve ser numérico')
            return
        }
        let dados = new FormData()
        dados.append('acao', 'checaCPF')
        dados.append('cpf', $('#cpf').val())
        $.ajax({
        url: '../PHP/formInscricao.php',
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
                document.getElementById('caixa2').removeAttribute("hidden")
                document.getElementById('caixa3').setAttribute("hidden", "")
                $('#nome').val(resposta.nome)
                $('#cpf_cad').val($('#cpf').val())
                $('#mae').val(resposta.mae)
                $('#rg').val(resposta.rg)
                $('#uf').val(resposta.uf)
                $('#orgao').val(resposta.orgao)
                $('#dt_expedi').val(resposta.dt_expedi)
                $('#dt_nasc').val(resposta.dt_nasc)
                $('#cpf_resp').val(resposta.cpf_resp)
                $('#nome_resp').val(resposta.nome_resp)
            }
        } )
        return
    }
)
$('#btn_enviar').click(
    function () {
        var politicas = document.getElementById("politicas");
        if(!politicas.checked){
            alert('Aceite as Politícas e Termos de Privacidade!')
            return;
        }
        if($('#cpf_cad').val() === '' || $('#nome').val() === '' || $('#mae').val() === '' || $('#rg').val() === '' || $('#orgao').val() === '' || $('#uf').val() === '' || $('#dt_expedi').val() === '' || $('#dt_nasc').val() === ''){
            alert('Preencha os campos Obrigatórios')
            return
        }
        if(Number($('#cpf_cad').val()) === NaN || Number($('#rg').val()) === NaN){
            alert('CPF e RG/RNE devem ser numéricos!')
            return
        }
        // Compara a data de nascimento com a data atual para checar maioridade e dados do responsável
        var date1 = new Date($('#dt_nasc').val());
        var date2 = new Date();
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffYears = Math.floor(timeDiff / (1000 * 3600 * 24 * 365));
        if(diffYears < 18){
            if($('#nome_resp').val() ==='' || $('#cpf_resp').val() === '' || Number($('#cpf_resp').val()) === NaN){
                alert('Menores de idade devem informar dados válidos de um responsável!')
                return
            }
        }
        let dados = new FormData()
        dados.append('acao', 'registrar')
        dados.append('nome', $('#nome').val())
        dados.append('cpf', $('#cpf_cad').val())
        dados.append('mae', $('#mae').val())
        dados.append('rg', $('#rg').val())
        dados.append('uf', $('#uf').val())
        dados.append('orgao', $('#orgao').val())
        dados.append('dt_expedi', $('#dt_expedi').val())
        dados.append('dt_nasc', $('#dt_nasc').val())
        dados.append('nome_resp', $('#nome_resp').val())
        dados.append('cpf_resp', $('#cpf_resp').val())
        dados.append('periodo', $('#periodo').val())
        dados.append('diassemana', $('#diassemana').val())
        dados.append('id_curso', id_curso)
        $.ajax({
        url: '../PHP/formInscricao.php',
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
                loadPag('principal', 'principal.html')
            }
        } )
        return
    }
)

var nome_curso = getParameter('curso')
var id_curso = getParameter('id_curso')

$('#nome_curso').html('<h4>Curso: '+nome_curso+'</h4>')

if(nome_curso === 'EMT'){
    $('#diassemana').html('<option value="1">Seg. a Sex.</option>')
    $('#periodo').html('<option value="4">Integral</option>')
}