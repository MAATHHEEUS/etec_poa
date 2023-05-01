var urlGlobal = ''

function getParameter ( parameterName ){
    if(urlGlobal === ''){
        let parameteres = new URLSearchParams( window.location.search )
        if(parameteres.get( "sessao" )){
            var decrypted = CryptoJS.AES.decrypt(parameteres.get( "sessao" ), "aes-128-gcm");
            let url = new URL("http://localhost/etec_poa/site_etec/HTML/?"+decrypted.toString(CryptoJS.enc.Utf8));
            parameteres = new URLSearchParams( url.search )
        }
        return parameteres.get( parameterName )
    }
    else{
        let url = new URL("http://localhost/etec_poa/site_etec/HTML/"+urlGlobal);
        let parameteres = new URLSearchParams( url.search )
        return parameteres.get( parameterName )
    }
}

// Pega o usuario id da URL se estiver logado
var usuarioId = getParameter('usuario')
// Pega o tipo de usuário da URL se estiver logado
var tipo_usr = getParameter('tipo')
//Pega o botão de acesso simple para trocar a cor conforme o tipo de usuário
var btn_acesso = document.getElementsByClassName("btn_acesso")[0];

switch(tipo_usr){
    case "admin":
        $('#menuPrincipal').html("<ul class=\"navbar-nav\"><li class=\"nav-item\">                        <a class=\"nav-link\" aria-current=\"page\" onclick=\"loadPag('principal', '../site_etec/HTML/usuario_crud.html');\" class=\"sem_linha\">Usuários</a>                    </li><li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/curso_crud.html');\">Cursos</a>                    </li>     <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/noticia_crud.html');\">Notícias</a>                    </li> <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/oportunidade_crud.html');\">Oportunidades</a>                    </li>  <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', 'relatorios_admin.html');\" id=\"urlDeclaracoes\">Relatórios</a>                    </li>  <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"\"></a>                    </li>        <div id=\"logOut\" hidden><li class=\"nav-item\"><a href=\"http://etecpoa.great-site.net/\" target=\"_self\" class=\"nav-link text-danger\">Sair</a></li></div>                       <li class=\"nav-item\">                        <div id=\"acesso_simple\" class=\"acesso_simple\" title=\"Acessar o SIMPLE\">                            <a class=\"btn_acesso\" onclick=\"abreMenuLogin();\">                                SIMPLE <img src=\"../../imagens/user.png\" alt=\"Ícone de usuário\" class=\"icon\">                            </a>                        </div>                    </li></div>      </li><li class=\"nav-item\">        <div id=\"ref_empresa\" class=\"ref_empresa\">            <span>Realização: </span>            <img src=\"../../imagens/logo.png\" alt=\"Logo da System For You\" class=\"logo\">        </ul>");

        if(usuarioId > 0){
            document.getElementById('urlDeclaracoes').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/relatorios_admin.html?usuario="+usuarioId+"');")
            btn_acesso = document.getElementsByClassName("btn_acesso")[0];
            btn_acesso.style.cssText =
    'background-color: red;' +
    'background-image: linear-gradient(red, yellow);';
        }
        break;

    case "prof":
        $('#menuPrincipal').html("<ul class=\"navbar-nav\"><li class=\"nav-item\">                        <a class=\"nav-link\" aria-current=\"page\" onclick=\"loadPag('principal', 'http://etecpoa.great-site.net/');\" class=\"sem_linha\">Principal</a>                    </li><li class=\"nav-item\">                        <a class=\"nav-link\" id=\"urlMaterias\" onclick=\"loadPag('principal', '../site_etec/HTML/materias.html');\">Matérias</a>                    </li>     <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/forum.html');\">Fórum</a>                    </li> <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', 'relatorios_prof.html');\" id=\"urlDeclaracoes\">Relatórios</a>                    </li>    <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"\"></a>                    </li>        <div id=\"logOut\" hidden><li class=\"nav-item\"><a href=\"http://etecpoa.great-site.net/\" target=\"_self\" class=\"nav-link text-danger\">Sair</a></li></div>                       <li class=\"nav-item\">                        <div id=\"acesso_simple\" class=\"acesso_simple\" title=\"Acessar o SIMPLE\">                            <a class=\"btn_acesso\" onclick=\"abreMenuLogin();\">                                SIMPLE <img src=\"../../imagens/user.png\" alt=\"Ícone de usuário\" class=\"icon\">                            </a>                        </div>                    </li></div>      </li><li class=\"nav-item\">        <div id=\"ref_empresa\" class=\"ref_empresa\">            <span>Realização: </span>            <img src=\"../../imagens/logo.png\" alt=\"Logo da System For You\" class=\"logo\">        </ul>");

        if(usuarioId > 0){
            document.getElementById('urlDeclaracoes').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/relatorios_prof.html?usuario="+usuarioId+"');")
            document.getElementById('urlMaterias').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/materias.html?usuario="+usuarioId+"');")
            btn_acesso = document.getElementsByClassName("btn_acesso")[0];
            btn_acesso.style.cssText =
    'background-color: blue;' +
    'background-image: linear-gradient(blue, yellow);';
        }
        break;

    case "aluno":
        $('#menuPrincipal').html("<ul class=\"navbar-nav\"><li class=\"nav-item\">                        <a class=\"nav-link\" aria-current=\"page\" onclick=\"loadPag('principal', 'http://etecpoa.great-site.net/');\" class=\"sem_linha\">Principal</a>                    </li><li class=\"nav-item\">                        <a class=\"nav-link\" id=\"urlRobo\" onclick=\"loadPag('principal', '../site_etec/HTML/robo.html');\">Robô</a>                    </li>     <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/forum.html');\">Fórum</a>                    </li> <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/oportunidades.html');\">Oportunidades</a>                    </li>  <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/denuncias.html');\">Denúncia/Sugestões</a>                    </li>  <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', 'declaracoes.html');\" id=\"urlDeclaracoes\">Declarações</a>                    </li>  <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"\"></a>                    </li>        <div id=\"logOut\" hidden><li class=\"nav-item\"><a href=\"http://etecpoa.great-site.net/\" target=\"_self\" class=\"nav-link text-danger\">Sair</a></li></div>                       <li class=\"nav-item\">                        <div id=\"acesso_simple\" class=\"acesso_simple\" title=\"Acessar o SIMPLE\">                            <a class=\"btn_acesso\" onclick=\"abreMenuLogin();\">                                SIMPLE <img src=\"../../imagens/user.png\" alt=\"Ícone de usuário\" class=\"icon\">                            </a>                        </div>                    </li></div>      </li><li class=\"nav-item\">        <div id=\"ref_empresa\" class=\"ref_empresa\">            <span>Realização: </span>            <img src=\"../../imagens/logo.png\" alt=\"Logo da System For You\" class=\"logo\">        </ul>");

        if(usuarioId > 0){
            document.getElementById('urlDeclaracoes').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/declaracoes.html?usuario="+usuarioId+"');")
            document.getElementById('urlRobo').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/robo.html?tipo="+tipo_usr+"');")
        }
        break;

    default:
        $('#menuPrincipal').html("<ul class=\"navbar-nav\"><li class=\"nav-item\">                        <a class=\"nav-link\" aria-current=\"page\" onclick=\"loadPag('principal', 'http://etecpoa.great-site.net/');\" class=\"sem_linha\">Principal</a>                    </li><li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/vagasRemanescentes.html');\">Vagas</a>                    </li>     <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"loadPag('principal', '../site_etec/HTML/robo.html');\">Robô</a>                    </li> <li class=\"nav-item\">                        <a class=\"nav-link\" onclick=\"\"></a>                    </li>                               <li class=\"nav-item\">                        <div id=\"acesso_simple\" class=\"acesso_simple\" title=\"Acessar o SIMPLE\">                            <a class=\"btn_acesso\" onclick=\"abreMenuLogin();\">                                SIMPLE <img src=\"../../imagens/user.png\" alt=\"Ícone de usuário\" class=\"icon\">                            </a>                        </div>                    </li><li class=\"nav-item\">        <div id=\"ref_empresa\" class=\"ref_empresa\">            <span>Realização: </span>            <img src=\"../../imagens/logo.png\" alt=\"Logo da System For You\" class=\"logo\">        </div>      </li></ul>");
}

function abreMenuLogin() {
    if(usuarioId > 0){
        document.getElementById('logOut').removeAttribute("hidden")
    }else{
        loadPag('principal', '../site_etec/HTML/acessoSimple.html')
    }
}

$("#principal").load("../site_etec/HTML/principal.html")

function loadPag(div, _url) {
    urlGlobal = _url
    $('#'+div).load(_url)
    return
}