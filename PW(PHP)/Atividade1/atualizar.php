<?php

if (isset($_POST['codigo'])) {
    if(file_exists("arq.txt") && !empty(file_exists('arq.txt'))){
        $lista = explode("\n", file_get_contents('arq.txt')); //Quebra por linhas
        $conjunto = 1;
        $contador = 0;
        while ($contador < count($lista)) {//Número de linhas
            if ('#' == $lista[$contador]) {//Achou a chave(um conjunto) 
                if ($conjunto == $_POST['codigo']) {//Se for o conjunto selecionado
                    $lista[$contador + 1] = "Nome: " . $_POST['nome'];// Atualiza a linha nome(+1)
                    $lista[$contador + 2] = "Abreviação: " . $_POST['abreavicao'];
                    $lista[$contador + 3] = "Fundação: " . $_POST['fundacao'];
                    $lista[$contador + 4] = "Cor primária: " . $_POST['cor1'];
                    $lista[$contador + 5] = "Cor secundária: " . $_POST['cor2'];
                    $lista[$contador + 6] = "Observações: " . $_POST['obs'];
                    $contador += 7;//Pula um conjunto = 7 Linhas

                    #Apaga as linhas no input mensagem se houver mais que uma linha
                    while('#' != $lista[$contador] and $contador <= count($lista)){//Enquanto não for outra chave e não acabou o arquivo
                        unset($lista[$contador]);
                        $contador++;
                    }
                    break;//Sai do while pois já atualizou o registro necessário
                }
                $conjunto++;
            }
            $contador++;
        }
        $contador = 0;
        $texto = "";
        while($contador < count($lista)){ // Monta o texto do arquivo denovo para salvar
            if(isset($lista[$contador])){
                $texto .= $lista[$contador] . "\n";
            }
            $contador++;
        }
        //apaga o arquivo para criar denovo
        unlink('arq.txt');
        $criar = fopen('arq.txt', 'a+');
        fwrite($criar, $texto);
        header('Location: select.php');
    }
}