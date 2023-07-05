<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Times</title>
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
                        $abreviacao = explode(':', $lista[$contador + 2]);
                        $abreviacao = $abreviacao[1];
                        $fundacao = explode(':', $lista[$contador + 3]);
                        $fundacao = $fundacao[1];
                        $cor1 = explode(':', $lista[$contador + 4]);
                        $cor1 = $cor1[1];
                        $cor2 = explode(':', $lista[$contador + 5]);
                        $cor2 = $cor2[1];
                        
                        $obs = explode(':', $lista[$contador + 6]);
                        $obs = $obs[1];
                        $contador += 7;//Pula um conjunto = 7 Linhas

                        #Verifica a quantidade de linhas no input observações
                        while ('#' != $lista[$contador] and $contador < count($lista) - 1) {//Verifica enquanto não aparece outra chave && não acabou o arquivo
                            $obs .= $lista[$contador];//Se tiver a linha adiciona a mensagem
                            $contador += 1;
                        }
                        break;//Sai do while
                    }
                    $conjunto += 1;
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
        <h1>Formulário - Edição de Time</h1><br/>
        
        <label for="codigo">Código: </label>
        <input type="number" name="codigo" id="codigo" style="background-color: red;" placeholder="<?php echo $_POST['codigo']; ?>" value="<?php echo $_POST['codigo']; ?>" readonly>
        
        <br/><br/><label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="<?php echo $nome; ?>" value="<?php echo $nome; ?>" autofocus required><br/>
        
        <br><label for="email">Abreviação: </label>
        <input type="text" name="abreavicao" id="abreviacao" placeholder="<?php echo $abreviacao; ?>" value="<?php echo $abreviacao; ?>" required maxlength="3"><br/>
        
        <br><label for="data">Fundação: </label>
        <input type="text" name="fundacao" id="fundacao" placeholder="<?php echo $fundacao; ?>" value="<?php echo $fundacao; ?>" required maxlength="10"><br/>

        <br><label for="cor1">Cor primária: </label>
        <input type="text" name="cor1" id="cor1" value="<?php echo $cor1; ?>"><br/>

        <br><label for="cor2">Cor secundária: </label>
        <input type="text" name="cor2" id="cor2" value="<?php echo $cor2; ?>"><br/>
        
        <br><label for="obs">Observações: </label>
        <br/><textarea type="text" name="obs" id="obs" rows="10" cols="40" placeholder="<?php echo $obs; ?>" required><?php echo $obs; ?></textarea>
        
        <br><input type="submit" value="Enviar">
    </form>

    <br/><br/>
    <button onclick="window.location.href = 'index.php'">Cadastro registro</button>
    <button onclick="window.location.href = 'deletar.php'">Deletar registro</button>
    <button onclick="window.location.href = 'select.php'">Selecionar registro</button>
    <button onclick="window.location.href = 'pegar.php'">Listar registro</button>
</body>
</html>