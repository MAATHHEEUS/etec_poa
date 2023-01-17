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

$acao = $_POST['acao'];
# Executa a ação solicitada pelo sistema    
switch ($acao) {
    case 'buscar':
        $conteudo = $_POST['conteudo'];
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
                $respostas = '<h4>Respostas:</h4>';
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
                        $respostas .= '<p>' . $row2['descricao'] . '<strong> - ' . $row2    ['autor'] . ' - ' . $row2['dt_cad'] . '</strong></p></div>';
                    }
                }
                $interacoes .= "<h2>" . $row['autor'] . " - (" . $row['dt_cad'] . ")</h2><p>" . $row['descricao'] . "</p>
                <br>";
                $interacoes .= $respostas;
                $interacoes .= '<div class="mb-3">
                <input type="button" value="RESPONDER" onclick="responder(' . $row['id_pergunta'] . ');" class="">
                </div><br>';
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => 'NENHUMA PERGUNDA DISPONÍVEL NO MOMENTO.!',
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
        $descricao = $_POST['descricao'];
        $autor = $_POST['autor'];

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
        $id_pergunta = $_POST['id_pergunta'];

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
        $descricao = $_POST['descricao'];
        $autor = $_POST['autor'];
        $id_pergunta = $_POST['id_pergunta'];

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