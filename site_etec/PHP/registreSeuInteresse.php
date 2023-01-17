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
    case 'registrar':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $ddd = $_POST['ddd'];
        $telefone = $_POST['telefone'];
        $periodo = $_POST['periodo'];
        $diassemana = $_POST['diassemana'];
        $qry = "INSERT INTO `tb_interesse`(`id_interesse`, `nome`, `email`, `ddd`, `telefone`, `periodo`, `diassemana`) VALUES (default,'$nome','$email','$ddd', '$telefone', '$periodo', '$diassemana')";

        if (!mysqli_query($conn, $qry)){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao inserir as informações!" . mysqli_error($conn)
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "Interesse registrado.\nAgora é só aguardar!!!",
        ));
        return;            
        break;
}