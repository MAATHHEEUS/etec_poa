<?php
    include_once "conexao.php";
    
    # Checa a conexão com banco
    if($conect == false){
        echo error;
        return;
    }
    
    if(isset($_POST["ok"])){
        if(mail($email, "Sua nova senha", "A sua senha de redefinição é essa: ")){
            echo 'AQUI';
        }
    exit;
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[] = "E-mail inválido";
        }

        $sql_code = "SELECT senha, usuario_id FROM tb_usuarios WHERE email = '$email' AND excluido = 'N'";
        $resultset = mysqli_query($conn, $sql_code);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo "Erro ao consultar o email. Contate o suporte com um print deste erro!".$sql_code;
            return;
        }

        # Verifica se retornou linhas
        $total = mysqli_num_rows($resultset);
        $dado = mysqli_fetch_assoc($resultset);

        if($total == 0){
            $erro[] = "O e-mail informado não existe no banco de dados";
        }

        if(count($erro) == 0 && $total > 0){
            $novasenha = substr(md5(time()), 0, 6);

            if(mail($email, "Sua nova senha", "A sua senha de redefinição é essa: ".$novasenha)){
                
                $sql_code = "UPDATE tb_usuarios SET senha = '$novasenha' WHERE email = '$email'";
                $resultset = mysqli_query($conn, $sql_code);

                # Verifica se deu certo a consulta
                if (!$resultset){
                    echo "Erro ao atualizar a senha. Contate o suporte com um print deste erro!".$sql_code;
                    exit;
                }else{
                    $erro[] = "Senha alterada com sucesso. Sua nova senha foi enviada para o seu email!";
                }
            }
        
        }

    }

?>

<html>
<head>
    <meta charset = "UTF-8">
</head>

<body>
    <?php 
        if(count($erro > 0))
        foreach($erro as $msg){
            echo "<p>$msg<p>";
        }
    ?>
<form method = "POST" action="">
    <input placeholder="Seu e-mail" name="email" type="text">
    <input name ="ok" value="OK" type="submit">
</form>

</body>
</html>