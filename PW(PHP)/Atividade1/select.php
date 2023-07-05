<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Times</title>
</head>
<body>
    <center><h1>Formulário Seleciona registro para para atualizar</h1></center>
    <form method="post" target="_self" action="update.php">
        <label for="codigo"> Digite o código do time para alterar:</label>
        <input type="number" id="codigo" name="codigo" required><br>
        <input type="submit" value="Enviar">
</form>
<br>
<?php
if (file_exists("arq.txt") && !empty(file_get_contents("arq.txt"))) {
    $lista = explode("\n", file_get_contents("arq.txt"));
    $conjunto = 1;
    $contador = 0;
    foreach ($lista as $lista_item) {//Para cada linha
        if ("#" == $lista[$contador]) {//Achou a chave para printar('Primary Key')
            echo $conjunto;
            $conjunto += 1;
        } 
        echo $lista_item . "<br>";//Printa Linha
        $contador += 1;
    }
}
else{
    echo "<br><br><p align=center> Ainda não há nenhum Registro!</p>";
}
?>
<br><br>
<button onclick="window.location.href = 'index.php'">Cadastrar registro</button>
<button onclick="window.location.href = 'deletar.php'">Deletar registro</button>
<button onclick="window.location.href = 'pegar.php'">Listar registro</button>
    
</body>
</form>
</html>