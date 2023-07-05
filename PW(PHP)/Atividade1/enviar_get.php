<?php
date_default_timezone_set('America/Sao_Paulo');

$erro = false;

# Checa a requisição
if (!isset($_GET) || empty($_GET)) {
    $erro = "<script language='javascript' type ='text/javascript'> alert('Nada foi Gerado!');window.location. href='index.php' </script>";
}

# Checa campos em branco e coleta dados
foreach ($_GET as $chave => $valor) {
    $$chave = trim(strip_tags($valor));

    if (empty($valor)) {
        $erro = "<script language='javascript' type ='text/javascript'> alert('Existem Campos em Branco!');window.location. href='index.php' </script>";
    }
}

#Formata dados
$dataBr = date("d/m/Y", strtotime($fundacao));
$abreviacaoUpper = strtoupper($abreviacao);

if ($erro) {
    echo  $erro;
}   else {
    echo "<h1> Veja os dados enviados </h1>";

    foreach ($_GET as $chave => $valor) {
        if($chave == 'Submit'){
            continue;
        }
        echo '<b>' . $chave . '</b>: ' . $valor . '<br><br>';
    }

    $arquivo = 'arq.txt';
    $conteudo = "#\nNome: " . $nome . "\nAbreviação:" . $abreviacaoUpper . "\nFundação: " . $dataBr . "\nCor primária: " . $cor1 . "\nCor secundária: " . $cor2 . "\nObservações: " . $obs . "\n";
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
