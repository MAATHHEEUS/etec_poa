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
    case 'registrar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $curso = mysqli_real_escape_string($conn, $_POST['curso']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $ddd = mysqli_real_escape_string($conn, $_POST['ddd']);
        $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
        $periodo = mysqli_real_escape_string($conn, $_POST['periodo']);
        $diassemana = mysqli_real_escape_string($conn, $_POST['diassemana']);
        $interesse = mysqli_real_escape_string($conn, $_POST['interesse']);

        $qry = "INSERT INTO `tb_interesse`(`id_interesse`, `nome`, `email`, `ddd`, `telefone`, `periodo`, `diassemana`, `curso`, `descricao`) VALUES (default,'$nome','$email','$ddd', '$telefone', '$periodo', '$diassemana', '$curso', '$interesse')";

        if (!mysqli_query($conn, $qry)){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao inserir as informações!" . $qry
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