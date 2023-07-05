<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Times</title>
</head>
<body>
    <center><h1> Formulário - Lista de Times </h1> </center>

    <?php
    if  (file_exists("arq.txt") && !empty(file_get_contents("arq.txt"))) {
        $lista = explode("\n", file_get_contents("arq.txt"));//Quebra em linhas
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
        echo "-----------------Fim de arquivo----------------------";
    } else {
        echo "<br><br><p align=center>Ainda não há nenhum registro!</p>";
    }
    ?>
    <br><br>
    <button onclick="window.location.href = 'index.php'">Cadastrar registro </button>
    <button onclick="window.location.href = 'deletar.php'">Deletar registro </button>
    <button onclick="window.location.href = 'select.php'">Atualizar registro </button>
</body>
</html>