<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud txt em php</title>
</head>
<body>
    <?php
    if (isset($_POST['codigo'])) {
        if(file_exists("arq.txt") && !empty(file_exists('arq.txt'))){
            $lista = explode("\n", file_get_contents('arq.txt')); //Quebra por linhas
            $conjunto = 1;
            $contador = 0;
            while ($contador < count($lista)) {//Número de linhas
                if ('#' == $lista[$contador]) {//Achou a chave(um conjunto) 
                    if ($conjunto == $_POST['codigo']) {//Se for o conjunto selecionado
                        $nome = explode(':', $lista[$contador + 1]);//Linha do nome(+1) quebrada pelo separador ':'
                        $nome = $nome[1];//Inicia a variavel nome
                        $email = explode(':', $lista[$contador + 2]);
                        $email = $email[1];
                        $data = explode(':', $lista[$contador + 3]);
                        $data = $data[1];
                        
                        $mensagem = explode(':', $lista[$contador + 4]);
                        $mensagem = $mensagem[1];
                        $contador += 5;//Pula um conjunto = 5 Linhas

                        #Verifica a quantidade de linhas no input mensagem
                        while ('#' != $lista[$contador] and $contador < count($lista) - 1) {//Verifica enquanto não aparece outra chave && não acabou o arquivo
                            $mensagem .= $lista[$contador];//Se tiver a linha adiciona a mensagem
                            $contador += 1;
                        }
                        break;//Sai do while
                    }
                    $conjunto++;
                }
                $contador += 1;
            }
        }
    }
    if(!$nome){// Não achou o registro selecionado 
        echo "<script language='javascript' type ='text/javascript'> alert('Código Selecionado inválido !');window.location. href='select.php' </script>";
    }
    ?>
    <form method="post" action="atualizar.php">
        <h1>Formulário - Atualizar registro</h1><br/>
        
        <label for="codigo">Código: </label>
        <input type="number" name="codigo" id="codigo" style="background-color: green;" placeholder="<?php echo $_POST['codigo']; ?>" value="<?php echo $_POST['codigo']; ?>" readonly>
        
        <br/><br/><label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="<?php echo $nome; ?>" value="<?php echo $nome; ?>" autofocus required><br/>
        
        <br><label for="email">Email: </label>
        <input type="text" name="email" id="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>" required><br/>
        
        <br><label for="data">Data: </label>
        <input type="text" name="data" id="data" placeholder="<?php echo $data; ?>" value="<?php echo $data; ?>" required><br/>
        
        <br><label for="mensagem">Mensagem: </label>
        <br/><textarea type="text" name="mensagem" id="mensagem" rows="10" cols="40" placeholder="<?php echo $mensagem; ?>" required><?php echo $mensagem; ?></textarea>
        
        <br><input type="submit" value="Enviar">
    </form>

    <br/><br/>
    <button onclick="window.location.href = 'index.php'">Cadastro registro</button>
    <button onclick="window.location.href = 'deletar.php'">Deletar registro</button>
    <button onclick="window.location.href = 'select.php'">Selecionar registro</button>
    <button onclick="window.location.href = 'pegar.php'">Listar registro</button>
</body>
</html>