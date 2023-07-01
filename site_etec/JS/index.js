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
        $('#menuPrincipal').html(`
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" style="cursor: pointer;" onclick="loadPag('principal', 'http://etecpoa.great-site.net/');">
                    <img src="imagens/logotipo-etec.png" alt="logo" class="img-fluid" style="width: 16.5rem;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="padding-right: 7rem;padding-left: 5rem;" id="primeiroLink">
                            <a class="nav-link" href="#" onclick='loadPag(\"principal\", \"../site_etec/HTML/usuario_crud.html\");' style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Usuarios</a>
                        </li>
                        <li class="nav-item" style="padding-right: 7rem;">
                            <a class="nav-link" href="#" onclick='loadPag(\"principal\", \"../site_etec/HTML/curso_crud.html\");' style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Cursos</a>
                        </li>
                        <li class="nav-item" style="padding-right: 7rem;">
                            <a class="nav-link" href="#" onclick='loadPag(\"principal\", \"../site_etec/HTML/noticia_crud.html\");' style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Notícias</a>
                        </li>
                        <li class="nav-item" style="padding-right: 7rem;">
                            <a class="nav-link" href="#" onclick='loadPag(\"principal\", \"../site_etec/HTML/oportunidade_crud.html\");' style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Oportunidades</a>
                        </li>
                        <li class="nav-item" style="padding-right: 7rem;">
                            <a class="nav-link" href="#" onclick='loadPag(\"principal\", \"relatorios_admin.html\");' id='urlDeclaracoes' style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Relatórios</a>
                        </li>
                        <div id="logOut" hidden>
                            <li class="nav-item" style="padding-right: 7rem;">
                                <a href="http://etecpoa.great-site.net/\" target="_self" class="nav-link" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Sair</a>
                            </li>
                        </div>
                    </ul>
                    <div style="flex: auto;" id="acesso_simple">
                        <a style="text-decoration: none; color: #B20000;" href="#" class="usuario" onclick="abreMenuLogin();" alt="Ícone de usuário"><i class="ri-user-fill"></i>Simple</a>
                        <div class="bx bx-menu" id="icone-menu"></div>
                    </div>
                </div>
            </div>
        </nav>`);

        if(usuarioId > 0){
            document.getElementById('urlDeclaracoes').setAttribute("onclick", "loadPag('principal', '../site_etec/HTML/relatorios_admin.html?usuario="+usuarioId+"');")
        }
        break;

    case "prof":
    $('#menuPrincipal').html(`
        <header>
            <img src=\"imagens/logotipo-etec.png\" alt=\"\" class=\"logo\" onclick=\"loadPag('principal', 'http://etecpoa.great-site.net/');\">
            <ul class=\"navbarpp\">            
                <li><a href=\"#\" class=\"\" aria-current='page' onclick=\"loadPag('principal', 'http://etecpoa.great-site.net/');\" class=\"sem_linha\">Principal</a></li>
                <li><a href=\"#\" id=\"urlMaterias\" onclick=\"loadPag('principal', '../site_etec/HTML/materias.html');\">Matérias</a></li>
                <li><a href=\"#\" onclick=\"loadPag('principal', '../site_etec/HTML/forum.html');\">Fórum</a></li>
                <li><a href=\"#\" onclick=\"loadPag('principal', 'relatorios_prof.html');\" id=\"urlDeclaracoes\">Relatórios</a></li>
                <div id=\"logOut\" hidden>
                <li><a href=\"http://etecpoa.great-site.net/\" target=\"_self\" >Sair</a></li></div>
            </ul>
            <div class="mainself" id="acesso_simple">
                <a href=\"#\" class=\"usuario\" class=\"btn_acesso\" onclick=\"abreMenuLogin();\"> <i class=\"ri-user-fill\"></i>Simple</a>   
            <div class="bx bx-menu" id="icone-menu"></div>
            </div>
        </header>`);

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
        $('#menuPrincipal').html(`
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" style="cursor: pointer;" onclick="loadPag('principal', 'http://etecpoa.great-site.net/');">
                    <img src="imagens/logotipo-etec.png" alt="logo" class="img-fluid" style="width: 16.5rem;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="padding-right: 10rem;padding-left: 5rem;" id="primeiroLink">
                            <a class="nav-link" href="#" onclick="loadPag('principal', 'http://etecpoa.great-site.net/');" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Principal</a>
                        </li>
                        <li class="nav-item" style="padding-right: 10rem;">
                            <a class="nav-link" href="#" onclick=\"loadPag('principal', '../site_etec/HTML/forum.html');\" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Fórum</a>
                        </li>
                        <li class="nav-item" style="padding-right: 10rem;">
                            <a class="nav-link" href="#" onclick=\"loadPag('principal', '../site_etec/HTML/oportunidades.html');\" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Oportunidades</a>
                        </li>
                        <li class="nav-item" style="padding-right: 10rem;">
                            <a class="nav-link" href="#" onclick=\"loadPag('principal', '../site_etec/HTML/denuncias.html');\" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Sua Opinião</a>
                        </li>
                        <div id="logOut" hidden>
                            <li class="nav-item" style="padding-right: 10rem;">
                                <a href="http://etecpoa.great-site.net/\" target="_self" class="nav-link" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Sair</a>
                            </li>
                        </div>
                    </ul>
                    <div style="flex: auto;" id="acesso_simple">
                        <a style="text-decoration: none; color: #B20000;" href="#" class="usuario" onclick="abreMenuLogin();" alt="Ícone de usuário"><i class="ri-user-fill"></i>Simple</a>
                        <div class="bx bx-menu" id="icone-menu"></div>
                    </div>
                </div>
            </div>
        </nav>`);

        break;

    default:
        $('#menuPrincipal').html(`
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" style="cursor: pointer;" onclick="loadPag('principal', 'http://etecpoa.great-site.net/');">
                    <img src="imagens/logotipo-etec.png" alt="logo" class="img-fluid" style="width: 16.5rem;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="padding-right: 10rem;padding-left: 5rem;" id="primeiroLink">
                            <a class="nav-link" href="#" onclick="loadPag('principal', '../site_etec/HTML/principal.html');" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Principal</a>
                        </li>
                        <li class="nav-item dropdown" style="padding-right: 10rem;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <a class="nav-link dropdown-toggle" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Etec</a>
                            <ul class="dropdown-menu dropdown-menu" style="background-color: whitesmoke;">
                                <li><a class="dropdown-item" onclick="loadPag('principal', '../site_etec/HTML/Cursos.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Nossos Cursos</a></li>
                                <li><a class="dropdown-item" onclick="window.open('https://www.vestibulinhoetec.com.br/home/', '_blank');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Vestibulinho</a></li>
                                <li><a class="dropdown-item" onclick="window.open('https://www.google.com/maps/place/ETEC+Po%C3%A1/@-23.5133664,-46.3430237,17z/data=!4m6!3m5!1s0x94ce7b3d56997a17:0x54f4214e9220a7f2!8m2!3d-23.5135951!4d-46.3435453!16s%2Fg%2F121k3mcf', '_blank');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Onde Estudar</a></li>
                                <li><a class="dropdown-item" onclick="window.open('https://www.cps.sp.gov.br/estudantes-de-mecanica-da-etec-de-mogi-das-cruzes-desenvolvem-tecnologias-assistivas/', '_blank');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Ações Inclusivas</a></li>
                                <li><a class="dropdown-item" onclick="loadPag('principal', '../site_etec/HTML/Responsa.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Responsabilidade Social</a></li>
                            </ul>
                        </li>
                        <div class="btn-group dropend">
                        <li class="nav-item dropdown" style="padding-right: 10rem;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <a class="nav-link dropdown-toggle" href="#" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Institucional</a>
                            <ul class="dropdown-menu" style="background-color: whitesmoke;">
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/QuemSomos.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Quem Somos</a></li>
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/CalendarioAcademico.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Calendário Acadêmico</a></li>
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/Parcerias.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Parcerias</a></li>
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/Direcao.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Direção</a></li>
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/FaleConosco.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Fale Conosco</a></li>
                                <li><a class="dropdown-item" href="#" onclick="loadPag('principal', '../site_etec/HTML/PrivacidadeTermosLicenca.html');" style="color: rgb(178, 0, 0); background-color: whitesmoke;" onMouseOver="this.style.color='whitesmoke'; this.style.backgroundColor='rgb(178, 0, 0)'" onMouseOut="this.style.color='rgb(178, 0, 0)'; this.style.backgroundColor='whitesmoke'">Informações Legais</a></li>
                            </ul>
                        </li>
                        </div>
                        <li class="nav-item" style="padding-right: 10rem;">
                            <a class="nav-link" href="#" onclick="loadPag('principal', '../site_etec/HTML/Informativo.html');" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Informativo ETEC</a>
                        </li>
                        <li class="nav-item" style="padding-right: 10rem;">
                            <a class="nav-link" href="#" onclick="loadPag('principal', '../site_etec/HTML/vagasRemanescentes.html');" style="color: #B20000" onMouseOver="this.style.color='#273336'" onMouseOut="this.style.color='#B20000'">Vagas</a>
                        </li>
                    </ul>
                    <div style="flex: auto;" id="acesso_simple">
                        <a style="text-decoration: none; color: #B20000;" href="#" class="usuario" onclick="abreMenuLogin();" alt="Ícone de usuário"><i class="ri-user-fill"></i>Simple</a>
                        <div class="bx bx-menu" id="icone-menu"></div>
                    </div>
                    <div id="logOut" hidden>
                        <a href="http://etecpoa.great-site.net/\" target="_self" class="nav-link text-danger">Sair</a>
                    </div>
                </div>
            </div>
        </nav>`);
}

window.addEventListener('resize', function () {
    var largura = window.innerWidth;

    if (largura < 750) {
        $('#primeiroLink').css('padding-left', '');
    }
    else{
        $('#primeiroLink').css('padding-left', '5rem');
    }
});

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