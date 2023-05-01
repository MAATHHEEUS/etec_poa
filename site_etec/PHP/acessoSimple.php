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
    case "checaLogin":
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        $qry = "SELECT * FROM tb_usuarios WHERE email = '$email'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar o Email. " . mysqli_error($conn)
            ));
            return;
            break;
        }
        
        # Verifica se retornou conteudo
        $qntd = mysqli_num_rows($resultset);
        if($qntd <= 0){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Email digitado ainda não cadastrado. Contate a Secretaria!"
            ));
            return;
            break;
        }

        $qry = "SELECT * FROM tb_usuarios WHERE email = '$email' AND senha = '$senha'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar o Email e Senha. " . mysqli_error($conn)
            ));
            return;
            break;
        }
        
        # Verifica se retornou conteudo
        $qntd = mysqli_num_rows($resultset);
        if($qntd <= 0){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Senha está incorreta."
            ));
            return;
            break;
        }

        $row = mysqli_fetch_assoc($resultset);

        if($senha == '00000'){
            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "Parece que este é seu primeiro acesso!\nVamos cadastrar uma nova senha!",
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "",
            'usuarioId' => $row['usuario_id'],
            'tipo_usr' => $row['tipo'] 
        ));
        return;            
        break;

    case "cadSenha":
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        $qry = "SELECT * FROM tb_usuarios WHERE email = '$email'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar o Email. " . mysqli_error($conn)
            ));
            return;
            break;
        }
        
        # Verifica se retornou conteudo
        $qntd = mysqli_num_rows($resultset);
        if($qntd <= 0){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Email digitado ainda não cadastrado. Contate a Secretaria!"
            ));
            return;
            break;
        }

        # Atualiza senha
        $qry = "UPDATE tb_usuarios SET senha = '$senha' WHERE email = '$email'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro atualizar a senha. " . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "Nova senha cadastrada com sucesso!"
        ));
        return;            
        break;
}