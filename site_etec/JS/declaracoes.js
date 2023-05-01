// Pega o usuario id da urlGlobal
var usuarioId = getParameter('usuario')

function print(dec){
    open("../site_etec/PHP/fpdf." + dec + ".php?usuario=" + usuarioId, "_blank")
    return
}