<?php
date_default_timezone_set('America/Sao_Paulo');

$nome = $_GET['nome'];
$email = $_GET['email'];
$data = $_GET['data'];
$mensagem = $_GET['mensagem'];
$dataBr = date("d/m/Y", strtotime($data));

$erro = false;

if (!isset($_GET) || empty($_GET)) {
    $erro = "<script language='javascript' type ='text/javascript'> alert('Nada foi Gerado!');window.location. href='index.php' </script>";
}

foreach ($_GET as $chave => $valor) {
    $$chave = trim(strip_tags($valor));

    if (empty($valor)) {

        $erro = "<script language='javascript' type ='text/javascript'> alert('Existem Campos em Branco!');window.location. href='index.php' </script>";
    }
}

if  ((!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) && $erro) {
    $erro = "<script language='javascript' type ='text/javascript'> alert('E-mail invalido!');window.location. href='index.php' </script>";
} 

if ($erro) {
    echo  $erro;
}   else {

    echo "<h1> Veja os dados enviados </h1>";

    foreach ($_GET as $chave => $valor) {
        echo '<b>' . $chave . '</b>: ' . $valor . '<br><br>';
    }

    $arquivo = 'arq.txt';
    $conteudo = "#\nNome: " . $nome . "\nemail:" . $email . "\nData: " . $dataBr . "\nMensagem: " . $mensagem . "\n";
    $criar = fopen($arquivo, "a+");
    $escrever = fwrite($criar, $conteudo);
    fclose($criar);

    if ($escrever == true ) {
        echo "Dados armazenados em $arquivo";        
    } else {
        echo "Erro ao salvar dados em $arquivo";
    }
}

?>
<br/><br/><br/>

<button onclick = "window.location.href = 'index.php'"> Cadastrar </button>
<button onclick = "window.location.href = 'pegar.php'"> Listar </button>
