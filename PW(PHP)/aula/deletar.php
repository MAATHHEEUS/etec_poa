<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud txt em php</title>
</head>
<body>
    <form method="get" target="_self">
        <center>
            <h1> Formulario - Selecionar registro para deletar</h1><br>
        </center>
        <label for="codigo"> Escolha o codigo de um registro de dados a ser deletado: </label>
        <input type="number" id="codigo" name="codigo" required> <br>
        <input type="submit" value="Enviar"><br> 
    </form>
<?php
if (file_exists("arq.txt") && !empty(file_get_contents("arq.txt"))) {
    $lista = explode("\n", file_get_contents("arq.txt"));
    $conjunto = 1; // variável para continuar a ordem de aparição do "indice", neste exemplo foi usado o '#'.
    echo "</br>";
    # Função read ou mais conhecido como select do conjunto de comandos SQL.
    foreach ($lista as $lista_item) { // vai percorrer todas as linhas do arquivo 
       //$coisa = explode($indice, $lista[$tmp2]);
    if ("#" == $lista_item)  { // Se achar um '#' no começo da linha, printa o valor atual da variável $conjunto e acrescenta mais um 
      echo $conjunto;
      $conjunto += 1;
    } 
    echo $lista_item . "<br>"; // para cada line break no arquivo, uma tag <br>
    }
    echo "---------------Fim de arquivo--------------";
    if (isset($_GET['codigo'])) {
        $conjunto = 1; // variável para guardar a ordem de aparição "indice", neste exemplo foi usado o '#'
        $contador = 0; // variável temporaria para manipulação do while  e do array $lista 
        $lista_itens = count($lista); // gravando quantos itens a lista tinha antes dos unsets
    
        while ($contador <  count($lista)) { // vai percorrer todo o array que foi criado com todas as linhas do arquivo
            if ("#" == $lista[$contador]) { //  se char um '#'  no começo da linha, valida  se o conjunto  é qual o usuário escolheu e acrescenta mais uma variável.
                if ($conjunto == $_GET['codigo']) {
                    unset($lista[$contador]);
                    while ("#" != $lista[$contador] and $contador != $lista_itens ) {
                        unset($lista[$contador]);
                        $contador += 1;
                    } // unsets para remover os elementos  da lista  que foi formada com as linhas do arquivo
                    break; // esta linha  é equivalente a um 'break';
                }
                $conjunto += 1;
            }
            $contador += 1;
        }
        
        $contador = 0; // variavel temporaria  para manipulação de array e da lista  $lista.
        $texto = ""; // futuro novo texto que estara no arquivo.
        while ($contador <  $lista_itens - 1 ) { // -1 para não colocar line breaks a mais no texto para cada execução
            if (isset($lista[$contador])) { // se não fez parte dos unsets do bloco de codigo anterior, será atribuido a variavel $texto
                $texto .= $lista[$contador] . "\n"; // elemento válido será juntado a um linebreak na variavel
            } 
            $contador += 1;
        }
        unlink('arq.txt'); // apaga o arquivo do diretorio
        $criar = fopen('arq.txt', "a+"); // cria  um novo  com o mesmo nome já com a permissão de escrita ("a+")
        fwrite($criar, $texto); // escreve no arquivo criado exatamente o que foi colocado na variável $texto
        fclose($criar); //"fecha" o arquivo para o apache
        header('Location: deletar.php'); // volta para a pagina de delete sem a atribuição do $_GET na URL;
    }
    } else {
        echo "<br><br><p align=center> Ainda não há nenhum registro!</p>"; // quando não tiver mais conjuntos ou o arquivo não existir, esta mensagem será exibida
    }
?>

<br><br>
<button onclick="window.location.href = 'index.php'"> Cadastrar registro</button>
<button onclick="window.location.href = 'select.php'"> Atualizar registro</button>
<button onclick="window.location.href = 'pegar.php'"> Listar registro</button>
    
</body>
</html> 