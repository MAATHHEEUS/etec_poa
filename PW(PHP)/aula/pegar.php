<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud txt em php</title>
</head>
<body>
    <center><h1> Formulário - Lista de registro </h1> </center>

    <?php
    if  (file_exists("arq.txt") && !empty(file_get_contents("arq.txt"))) {
        $lista = explode("\n", file_get_contents("arq.txt"));
        #var_dump($lista); usar essa linha para exibir o conteúdo do vetor 
        $conjunto = 1;
        $contador = 0;
        foreach ($lista as $lista_item)     {
            #var_dump($lista_item); usar essa linha para explicar a função explode 
            //$coisa = explode($indice, $lista[$tmp2]);
            if ("#" == $lista[$contador]) {
                echo $conjunto;
                $conjunto += 1;
            } 
            echo $lista_item . "<br>";

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