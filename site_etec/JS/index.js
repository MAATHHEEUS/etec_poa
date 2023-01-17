var urlGlobal = ''

function getParameter ( parameterName ){
    if(urlGlobal === ''){
        let parameteres = new URLSearchParams( window.location.search )
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

if(usuarioId > 0){
    document.getElementById('userMenu').removeAttribute("hidden")
    document.getElementById('noUserMenu').setAttribute("hidden", "")
}

document.getElementById('urlDeclaracoes').setAttribute("onclick", "loadPag('principal', 'declaracoes.html?usuario="+usuarioId+"');")

function abreMenuLogin() {
    if(usuarioId > 0){
        document.getElementById('logOut').removeAttribute("hidden")
    }else{
        loadPag('principal', 'acessoSimple.html')
    }
}

$("#principal").load("principal.html")

function loadPag(div, _url) {
    urlGlobal = _url
    $('#'+div).load(_url)
    return
}