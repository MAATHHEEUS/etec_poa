<?php

$acao = $_POST['acao'];
# Executa a ação solicitada pelo sistema    
switch ($acao) {
    case 'salvar':
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        
        $arquivo = 'main-campo-arq.txt';
        $conteudo = "#\nNome: " . $nome . "\nEndereço:" . $endereco. "\n";
        $criar = fopen($arquivo, "a+");
        $escrever = fwrite($criar, $conteudo);
        fclose($criar);

        if ($escrever == true ) {
            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "Dados cadastrados com sucesso"
            ));
            return;            
            break;       
        } else {
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar dados"
            ));
            return;            
            break;
        }

    case 'atualizar':
        $id_campo = $_POST['id_campo'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        
        if(file_exists("main-campo-arq.txt") && !empty(file_exists('main-campo-arq.txt'))){
            $lista = explode("\n", file_get_contents('main-campo-arq.txt')); //Quebra por linhas
            $conjunto = 1;
            $contador = 0;
            while ($contador < count($lista)) {//Número de linhas
                if ('#' == $lista[$contador]) {//Achou a chave(um conjunto) 
                    if ($conjunto == $id_campo) {//Se for o conjunto selecionado
                        $lista[$contador + 1] = "Nome: " . $nome;// Atualiza a linha nome(+1)
                        $lista[$contador + 2] = "Endereço: " . $endereco;
                        $contador += 3;//Pula um conjunto = 3 Linhas
    
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
            unlink('main-campo-arq.txt');
            $criar = fopen('main-campo-arq.txt', 'a+');
            fwrite($criar, $texto);

            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "Dados editados com sucesso"
            ));
            return;            
            break;
        }
        echo json_encode(array(
            'tipo' => 'E',
            'msg' => "404. Arquivo de leitura não encontrado"
        ));
        return;            
        break;

    case 'consultar':
        $codigo = $_POST['codigo'];

        if(file_exists("main-campo-arq.txt") && !empty(file_exists('main-campo-arq.txt'))){
            $lista = explode("\n", file_get_contents('main-campo-arq.txt')); //Quebra por linhas
            $conjunto = 1;
            $contador = 0;
            while ($contador < count($lista)) {//Número de linhas
                if ('#' == $lista[$contador]) {//Achou a chave(um conjunto) 
                    if ($conjunto == $_POST['codigo']) {//Se for o conjunto selecionado
                        $nome = explode(':', $lista[$contador + 1]);//Linha do nome(+1) quebrada pelo separador ':'
                        $nome = $nome[1];//Inicia a variavel nome
                        $endereco = explode(':', $lista[$contador + 2]);
                        $endereco = $endereco[1];
                        $contador += 3;//Pula um conjunto = 3 Linhas
                        break;//Sai do while
                    }
                    $conjunto++;
                }
                $contador += 1;
            }
        }
        if(!$nome){// Não achou o registro selecionado 
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'Código selecionado inválido'
            ));
            return;            
            break;
        }else {
            echo json_encode(array(
                'tipo' => 'OK',
                'id' => $codigo,
                'nome' => $nome,
                'endereco' => $endereco
            ));
            return;            
            break;
        }

    case 'pegar':
        $grid = "";
        if  (file_exists("main-campo-arq.txt") && !empty(file_get_contents("main-campo-arq.txt"))) {
            $lista = explode("\n", file_get_contents("main-campo-arq.txt"));
            #var_dump($lista); usar essa linha para exibir o conteúdo do vetor 
            $conjunto = 1;
            $contador = 0;
            foreach ($lista as $lista_item)     {
                #var_dump($lista_item); usar essa linha para explicar a função explode 
                //$coisa = explode($indice, $lista[$tmp2]);
                if ("#" == $lista[$contador]) {
                    $grid .= $conjunto;
                    $conjunto += 1;
                } 
                $grid .= $lista_item . "<br>";
    
                $contador += 1;
            }
            $grid .= "-----------------Fim de arquivo----------------------";
        } else {
            $grid .= "<br><br><p align=center>Ainda não há nenhum registro!</p>";
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'grid' => $grid
        ));
        return;            
        break;


    case 'excluir':
        $id_campo = $_POST['id'];

        if (file_exists("main-campo-arq.txt") && !empty(file_get_contents("main-campo-arq.txt"))) {
            $conjunto = 1; // variável para guardar a ordem de aparição "indice", neste exemplo foi usado o '#'
            $contador = 0; // variável temporaria para manipulação do while  e do array $lista 
            $lista_itens = count($lista); // gravando quantos itens a lista tinha antes dos unsets
        
            while ($contador <  count($lista)) { // vai percorrer todo o array que foi criado com todas as linhas do arquivo
                if ("#" == $lista[$contador]) { //  se char um '#' no começo da linha, valida  se o conjunto  é qual o usuário escolheu e acrescenta mais uma variável.
                    if ($conjunto == $id_campo) {
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
            unlink('main-campo-arq.txt'); // apaga o arquivo do diretorio
            $criar = fopen('main-campo-arq.txt', "a+"); // cria  um novo  com o mesmo nome já com a permissão de escrita ("a+")
            fwrite($criar, $texto); // escreve no arquivo criado exatamente o que foi colocado na variável $texto
            fclose($criar); //"fecha" o arquivo para o apache

            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "Registro excluido!",
            ));
            return;            
            break;
        }
        
        echo json_encode(array(
            'tipo' => 'E',
            'msg' => "404. Arquivo de leitura não encontrado"
        ));
        return;            
        break;
        
}