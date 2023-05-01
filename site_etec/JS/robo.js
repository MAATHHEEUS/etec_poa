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

var tipo_usr = getParameter('tipo')

switch(tipo_usr){
    case "aluno":
        $('#div_perguntas_respostas').html("<div id=\"pergunta1\">                            <a onclick=\"showResposta('resposta1');\"><p>Onde posso solicitar/pegar uma declaração?</p></a>                            <div id=\"resposta1\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong>Na aba declarações!</strong>                            </div>                        </div>                        <div id=\"pergunta2\">                            <a onclick=\"showResposta('resposta2');\"><p>As denúncias são realmente anônimas?</p></a>                            <div id=\"resposta2\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong> Sim!</strong>                            </div>                        </div>                        <div id=\"pergunta3\">                            <a onclick=\"showResposta('resposta3');\"><p>Terá aula hoje?</p></a>                            <div id=\"resposta3\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong>                                    Com certeza, sempre é tempo de aprender!</strong>                                <br>                            </div>                        </div>                        <div id=\"pergunta4\">                            <a onclick=\"showResposta('resposta4');\"><p>Alguma Pergunta ?</p></a>                            <div id=\"resposta4\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong> Resposta!</strong><br>                            </div>                        </div>                        <div id=\"pergunta5\">                            <a onclick=\"showResposta('resposta5');\"><p>Entre em contato</p></a>                            <div id=\"resposta5\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong>Nossos contatos são:  <a href=\"http://systemforyou.great-site.net/\" target=\"_blank\">Site</a> - <a href=\"https://www.linkedin.com/in/system-fy/\" target=\"_blank\">Linkedin</a> - Email - sistem.fy@suporte.com</strong>                            </div>                        </div>");
        break;

    default:
        $('#div_perguntas_respostas').html("<div id=\"pergunta1\">                            <a onclick=\"showResposta('resposta1');\"><p>O que é Vestibulinho?</p></a>                            <div id=\"resposta1\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong>O Vestibulinho é o método de avaliação para adentrar a nossa instituição!</strong>                            </div>                        </div>                        <div id=\"pergunta2\">                            <a onclick=\"showResposta('resposta2');\"><p>Quais são os requisitos para fazer o curso?</p></a>                            <div id=\"resposta2\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong> Vontade de aprender!</strong>                            </div>                        </div>                        <div id=\"pergunta3\">                            <a onclick=\"showResposta('resposta3');\"><p>Como fazer a inscrição?</p></a>                            <div id=\"resposta3\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong><a href=\"https://www.vestibulinhoetec.com.br/candidato/dados-acesso.asp\" target=\"_blank\">                                    Inscreva-se                                </a></strong><br>                            </div>                        </div>                        <div id=\"pergunta4\">                            <a onclick=\"showResposta('resposta4');\"><p>Como é a classificação?</p></a>                            <div id=\"resposta4\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong> Quem acertar mais questões da prova passa!</strong><br>                            </div>                        </div>                        <div id=\"pergunta5\">                            <a onclick=\"showResposta('resposta5');\"><p>Entre em contato</p></a>                            <div id=\"resposta5\" hidden>                                <img src=\"../../imagens/robo_icon.png\" alt=\"robo_icon\" class=\"icon\" style=\"width: 35px; height: 35px;\"><strong>Nossos contatos são:  <a href=\"http://systemforyou.great-site.net/\" target=\"_blank\">Site</a> - <a href=\"https://www.linkedin.com/in/system-fy/\" target=\"_blank\">Linkedin</a> - Email - sistem.fy@suporte.com</strong>                            </div>                        </div>");
}