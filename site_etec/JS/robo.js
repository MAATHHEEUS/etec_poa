function showResposta(resposta) {
    switch (resposta) {
        case 'resposta1':
            document.getElementById(resposta).removeAttribute("hidden")
            document.getElementById('resposta2').setAttribute("hidden", "")        
            document.getElementById('resposta3').setAttribute("hidden", "")        
            document.getElementById('resposta4').setAttribute("hidden", "")        
            document.getElementById('resposta5').setAttribute("hidden", "")        
            break;
        case 'resposta2':
            document.getElementById(resposta).removeAttribute("hidden")
            document.getElementById('resposta1').setAttribute("hidden", "")        
            document.getElementById('resposta3').setAttribute("hidden", "")        
            document.getElementById('resposta4').setAttribute("hidden", "")        
            document.getElementById('resposta5').setAttribute("hidden", "")        
            break;
        case 'resposta3':
            document.getElementById(resposta).removeAttribute("hidden")
            document.getElementById('resposta2').setAttribute("hidden", "")        
            document.getElementById('resposta1').setAttribute("hidden", "")        
            document.getElementById('resposta4').setAttribute("hidden", "")        
            document.getElementById('resposta5').setAttribute("hidden", "")        
            break;
        case 'resposta4':
            document.getElementById(resposta).removeAttribute("hidden")
            document.getElementById('resposta2').setAttribute("hidden", "")        
            document.getElementById('resposta3').setAttribute("hidden", "")        
            document.getElementById('resposta1').setAttribute("hidden", "")        
            document.getElementById('resposta5').setAttribute("hidden", "")        
            break;
        case 'resposta5':
            document.getElementById(resposta).removeAttribute("hidden")
            document.getElementById('resposta2').setAttribute("hidden", "")        
            document.getElementById('resposta3').setAttribute("hidden", "")        
            document.getElementById('resposta4').setAttribute("hidden", "")        
            document.getElementById('resposta1').setAttribute("hidden", "")        
            break;
    }
}