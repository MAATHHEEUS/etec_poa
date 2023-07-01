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
        $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);
        
        # Busca as dúvidas
        $qry = "select * from tb_interacoes where descricao like '%$conteudo%' order by dt_cad desc limit 2";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as interações. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        $interacoes = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            while($row = mysqli_fetch_assoc($resultset)){
                # Busca duas respostas para cada interação(id_pergunta)
                $respostas = '<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Ultimas Respostas</h6>
</div>';
                
                $qry = "select * from tb_respostas where id_pergunta = " . $row['id_pergunta'] . " order by dt_cad desc limit 2";
                
                $resultset2 = mysqli_query($conn, $qry);

                # Verifica se deu certo a consulta
                if (!$resultset2){
                    echo json_encode(array(
                        'tipo' => 'E',
                        'msg' => "Erro ao consultar as respostas da pergunta: . ". $row['id_pergunta'] . mysqli_error($conn)
                    ));
                    return;
                    break;
                }

                # Verifica se retornou linhas (respostas)
                $qntd2 = mysqli_num_rows($resultset2);
                if ($qntd2 > 0) {
                    while($row2 = mysqli_fetch_assoc($resultset2)){
                        $dtFormat = converteData('padrao', $row2['dt_cad']);
$respostas .= '<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex text-body-secondary pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title></title>
            <rect width="100%" height="100%" fill="#007bff" />
            <text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
        </svg>
        <p class="pb-3 mb-0 small lh-sm border-bottom" style="width: 50%;">
            <strong class="d-block text-gray-dark">' . $row2['autor'] . ' - ' . $dtFormat . '</strong>
            ' . $row2['descricao'] . ' </p>
    </div>
</div>';

                    }
                }else{
                    $respostas .= '<p class="text-danger">Ainda sem respostas!</p><hr>';
                }
                
              $dtFormat = converteData('padrao', $row['dt_cad']);
$interacoes .= '<div class="card gedf-card");">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="" style="margin-right: 10px;">
                </div>
                <div class="ml-2">
                    <div class="h5 m-0"  style="text-transform: capitalize;">' . $row['autor'] . '</div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-muted h7 mb-2"  style="text-transform: capitalize;"> <i class="fa fa-clock-o"></i>' . $row['autor'] . ' - (' . $dtFormat . ')</div>
        <p class="card-text">
            ' . $row['descricao'] . '
        </p>
    </div>
    <div class="card-footer">
        <a onclick="responder(' . $row['id_pergunta'] . ');" style="cursor: pointer;"><i class="fa fa-comment"></i> Responder </a>
    </div>
</div>';
              $interacoes .= $respostas;
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => 'NENHUMA PERGUNTA DISPONÍVEL NO MOMENTO!',
                'interacoes' => ''
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'interacoes' => $interacoes,
            'msg' => ''
        ));
        return;            
        break;

    case 'perguntar':
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $autor = mysqli_real_escape_string($conn, $_POST['autor']);

        $today = getdate();
        $dt_cad = $today['year']."-".$today['mon']."-".$today['mday'];

        # Insere
        $qry = "insert into tb_interacoes values(default, '$autor', '$dt_cad', '$descricao')";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao registrar a pergunta" . mysqli_error($conn)
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Pergunta Feita, Agora aguarde que alguém interaja.'
        ));
        return;            
        break;

    case 'dadosPergunta':
        $id_pergunta = mysqli_real_escape_string($conn, $_POST['id_pergunta']);

        # Busca
        $qry = "select * from tb_interacoes where id_pergunta = '$id_pergunta'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao registrar a pergunta" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $row = mysqli_fetch_assoc($resultset);

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => '',
            'descricao' => $row['descricao']
        ));
        return; 
        break;

    case 'responder':
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $autor = mysqli_real_escape_string($conn, $_POST['autor']);
        $id_pergunta = mysqli_real_escape_string($conn, $_POST['id_pergunta']);

        $today = getdate();
        $dt_cad = $today['year']."-".$today['mon']."-".$today['mday'];

        # Insere
        $qry = "insert into tb_respostas values(default, '$autor', '$dt_cad', '$descricao', '$id_pergunta')";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao registrar a resposta" . mysqli_error($conn)
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Resposta Feita, Agora aguarde que alguém interaja.'
        ));
        return;            
        break;
}