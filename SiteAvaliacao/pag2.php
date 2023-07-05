<?php
    $avaliacao = $_GET['avaliacao'];
    $estrela = $_GET['estrela'];

    $file = "avaliacoes.txt";
    if(file_exists($file)){
        $aux = fopen($file, "a");
        fwrite($aux, "Estrela: ".$estrela." - Opnião: ".$avaliacao."\n");
        fclose($aux);
    }
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SYSTEM FOR YOU</title>
    <link rel="icon" type="image/x-icon" href="SYSFY.png">
    <style>
        .checked {
            color: orange;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <body style="align-items: center; text-align: center; background-color: blueviolet;">
        <img src="SYSFY.png" class="rounded mx-auto d-block mt-5" alt="Empresa">
        <div class="container">
            <p style="color: gold;" class="fs-1 fw-bold m-3">OBRIGADO PELA AVALIAÇÃO MOSTRE ESSA TELA E RECEBA SEU PIRULITO!</p>
        </div>

        <img src="PIRU.gif" class="rounded mx-auto d-block m-5" alt="Empresa">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>