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
    case "salvar":
        $descricao = $_POST['descricao'];

        $today = getdate();
        $dtcad = $today['year']."-".$today['mon']."-".$today['mday'];

        $qry = "INSERT INTO tb_denuncias VALUES(default, '$dtcad','$descricao')";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar a denúncia/sugestão. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "Obrigado por compartilhar sua opinião conosco!"
        ));
        return;            
        break;
}