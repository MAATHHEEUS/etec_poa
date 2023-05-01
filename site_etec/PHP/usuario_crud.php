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
        # Busca todos os usuários
        $qry = "select * from tb_usuarios WHERE excluido = 'N' order by tipo";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar os usuarios. Contate o supoerte com um print deste erro!".$qry
            ));
            return;
            break;
        }

        $grid = "<table class='table table-hover table-light'>";

        #cabeçalho da lista
        $grid .= "<thead class=\"thead-dark\"><tr>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr></thead><tbody>";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $grid .= "<tr>
                            <td>".$row['email']."</td>
                            <td>".$row['tipo']."</td>
                            <td><input type='button' class=\"btn btn-success m-1 btn-sm p-1\" value='EDITAR' onclick='Editar(".$row["usuario_id"].")';><input type='button' class=\"btn btn-danger m-1 btn-sm p-1\" value='DELETAR' onclick='Deletar(".$row["usuario_id"].")';></input></td>
                        </tr>";
                $contador++;
            }
            $grid .= "</tbody>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUM USUÁRIO CADASTRADO!'
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
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

        # Atualiza o campo excluido
        $qry = "UPDATE `tb_usuarios` SET `excluido` = 'S' WHERE usuario_id = ".$usuario;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao deletar usuário. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Usuário Excluído com sucesso!'
        ));
        return;            
        break;

    case 'editar':
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

        # Busca os dados do usuario para edição
        $qry = "select * from tb_usuarios WHERE excluido = 'N' and usuario_id = ".$usuario;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao editar usuário. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }
        $row = mysqli_fetch_assoc($resultset);

        echo json_encode(array(
            'tipo' => 'OK',
            'email' => $row['email'],
            'tipo_usr' => $row['tipo'],
            'id' => $row['usuario_id']
        ));
        return;            
        break;

    case 'salvar':
        $usuario = mysqli_real_escape_string($conn, $_POST['id']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);

        $senha = '00000';

        # Salva ou atualiza
        if($usuario != ''){
            $qry = "UPDATE `tb_usuarios` SET `email` = '".$email."', `tipo` = '".$tipo."' WHERE usuario_id = ".$usuario;
            $msg = 'Usuário atualizado!';
        }else{
            $qry = "INSERT INTO `tb_usuarios`(`email`, `senha`, `tipo`) VALUES ('".$email."', '".$senha."', '".$tipo."')";
            $msg = 'Usuário cadastrado com senha padrão!';
        }
        
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar usuário. Contate o suporte com print deste erro!" . $qry
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