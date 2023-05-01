<?php
include_once "conexao.php";
date_default_timezone_set('America/Sao_Paulo');

# Checa a conexão com banco
if($conect == false){
    echo json_encode(array(
        'tipo' => 'E',
        'msg' => $error
    ));
    return;
}

$acao = mysqli_real_escape_string($conn, $_POST['acao']);
# Executa a ação solicitada pelo sistema    
switch ($acao) {
    case 'buscar':
        # Busca todas as notícias
        $qry = "SELECT * FROM `tb_noticias` WHERE `nome_arq` <> 'logo.png' order by dtcad desc";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as notícias. Contate o suporte com um print deste erro!".$qry
            ));
            return;
            break;
        }

        $grid = "<table class='table table-hover table-light'>";

        #cabeçalho da lista
        $grid .= "<thead class=\"thead-dark\"><tr>
                    <th>Título</th>
                    <th>Data Cadastro</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr></thead><tbody>";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                $dtformat = converteData('padrao', $row['dtcad']);
                # Monta a tabela 
                $class = "";
                if($contador < getQuantidadeNoticias()){
                    $class = "table-active";
                }
                $grid .= "<tr  class=".$class.">
                            <td>".$row['titulo']."</td>
                            <td>".$dtformat."</td>
                            <td>".substr($row['descricao'], 0, 50)."...</td>
                            <td><input type='button' class=\"btn btn-danger m-1 btn-sm p-1\" value='DELETAR' onclick='Deletar(".$row["noticia_id"].")';></input></td>
                        </tr>";
                $contador++;
            }
            $grid .= "</tbody>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA NOTÍCIA CADASTRADA!'
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'grid' => $grid,
            'msg' => ''
        ));
        return;            
        break;

    case 'deletar':
        $noticia = mysqli_real_escape_string($conn, $_POST['noticia']);

        # Busca o registro pelo id
        $qry = "SELECT * FROM `tb_noticias` WHERE noticia_id = '$noticia'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao editar o registro. " . $qry
            ));
            return;
        }

        $row = mysqli_fetch_assoc($resultset);

        #Pega o nome do arquivo para excluir
        $nome_arq = $row['nome_arq'];

        # delete o arquivo da pasta imagens se existir
        if ($nome_arq != null) {
            if(!unlink("../../imagens/". $nome_arq)){
                echo json_encode(array(
                    'tipo' => 'E',
                    'msg' => "Erro ao excluir a imagem."
                ));
                return;
            }
        }

        # Deleta a notícia
        $qry = "DELETE FROM `tb_noticias` WHERE noticia_id = ".$noticia;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao deletar Notícia porém imagem já excluída. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Notícia e imagem Excluídas com sucesso!'
        ));
        return;            
        break;

    case 'salvar':
        # Pega as informações do arquivo de imagem
        $imagem = $_FILES['imagem']['tmp_name'];
        $tamanho = $_FILES['imagem']['size'];
        $nome_arq = $_FILES['imagem']['name'];

        # Criar um arquivo para imagem
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);

        # Move o arquivo para a pasta de imagens
        $arquivo_path = "../../imagens/". $nome_arq . "";
        move_uploaded_file($imagem, $arquivo_path);
       
        $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $today = getdate();
        $dtcad = $today['year']."/".$today['mon']."/".$today['mday'];

        # Salva
       
        $qry = "INSERT INTO `tb_noticias`(`titulo`, `dtcad`, `descricao`, `nome_arq`) VALUES ('".$titulo."', '".$dtcad."', '".$descricao."', '".$nome_arq."')";
        $msg = 'Notícia cadastrada.';
        
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar notícia. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => $msg
        ));
        return;            
        break;
}