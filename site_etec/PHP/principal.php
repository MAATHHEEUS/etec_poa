<?php
include_once "conexao.php";

# Checa a conexão com banco
if($conect == false){
    echo json_encode(array(
        'tipo' => 'E',
        'msg' => $error
    ));
    return;
}

$acao = $_POST['acao'];
# Executa a ação solicitada pelo sistema    
switch ($acao) {
    case 'carregaNoticias':
        # Busca as oportunidades
        $qry = "select * from tb_noticias order by dtcad desc limit 2";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as notícias. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        $noticias = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $noticias .= "<h2>" . $row['titulo'] . " - (" . $row['dtcad'] . ")</h2>";
                $noticias .= '<div clas="noticia"><img src="../../imagens/logo.png" alt="imagem da noticia 1"><p>' . $row['descricao'] . '</p></div><br>';
                $contador++;
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA NOTÍCIA DISPONÍVEL NO MOMENTO.!'
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'noticias' => $noticias,
            'msg' => ''
        ));
        return;            
        break;

    case 'dadosOportunidade':
        $id_oportunidade = $_POST['id_oportunidade'];

        # Busca informações do curso
        $qry = "select * from tb_oportunidades where oportunidade_id = '$id_oportunidade'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar informações da oportunidade" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $row = mysqli_fetch_assoc($resultset);

        $nome = '<h4>' . $row['tipo'] . ': ' . $row['nome'] . '</h4>';
        $resumo = '<p><strong>Resumo: </strong> ' . $row['resumo'] . '</p>';
        $requisitos = '<p><strong>Requisitos: </strong> ' . $row['requisitos'] . ' </p>';
        $link = '<strong>Site para inscrição: </strong><a href="https://' . $row['site'] . '" target="_blank" class="sem_linha">' . $row['site'] . '</a>';

        echo json_encode(array(
            'tipo' => 'OK',
            'nome' => $nome,
            'msg' => '',
            'resumo' => $resumo,
            'requisitos' => $requisitos,
            'link' => $link,
            'contato' => $row['contato'],
            'empresa' => $row['empresa'],
            'area' => $row['area']
        ));
        return;            
        break;
}