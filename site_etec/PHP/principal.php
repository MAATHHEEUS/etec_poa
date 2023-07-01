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

$acao = mysqli_real_escape_string($conn, $_POST['acao']);
# Executa a ação solicitada pelo sistema    
switch ($acao) {
    case 'carregaNoticias':
        $tipo_usuario = mysqli_real_escape_string($conn, $_POST['tipo_usuario']);

        $interessado = 'Geral';
        if($tipo_usuario == 'aluno'){
            $interessado = 'Aluno';
        }

        # Busca as notícias
        $qry = "select * from tb_noticias where interessado = '$interessado' order by dtcad desc limit " . getQuantidadeNoticias();
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as notícias. #Contate o suporte com print dessa mensagem!",
                'debug' => $qry
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
                # Formata data vinda do banco
                $dtformat = converteData('padrao', $row['dtcad']);
                
                # Monta as noticias
                $noticias .= '
<div class="w3-content w3-display-container">
    <div class="carousel slide mySlides">
        <img class="d-block w-100"  src="../../imagens_noticias/' . $row['nome_arq'] . '"  alt="' . $row['nome_arq'] . '">
        <div class="carousel-caption d-none d-md-block noticia">
            <h2 class="titleslider">' . $row['titulo'] . ' - (' . $dtformat . ')</h2>
            <p class="textslider">' . $row['descricao'] . '</p>
            <a href="' . $row['link'] . '" target="_blank" class="btn btn-dark" style="background: #273336;" onmouseover="this.style.backgroundColor=\'#7C0D00\'" onmouseout="this.style.backgroundColor=\'#273336\'">ACESSAR NOTÍCIA</a>
        </div>
    </div>
</div>
';

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
        $id_oportunidade = mysqli_real_escape_string($conn, $_POST['id_oportunidade']);

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