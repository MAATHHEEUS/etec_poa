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
        $id_curso = $_POST['id_curso'];
        $cpf = $_POST['cpf'];

        # Verifica se o cpf já está cadastrado
        $qry = "SELECT * FROM `tb_inscricoes` WHERE cpf = '$cpf'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar o CPF. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        # Verifica se retornou conteudo
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $row = mysqli_fetch_assoc($resultset);
            $id_inscricao = $row['id_inscricao'];
            # Já está cadastrado só altera o curso_id
            $qry = "UPDATE `tb_inscricoes` SET id_curso = '$id_curso' WHERE id_inscricao = '$id_inscricao'";
            $resultset = mysqli_query($conn, $qry);

            # Verifica se deu
            if (!$resultset){
                echo json_encode(array(
                    'tipo' => 'E',
                    'msg' => "Erro ao atualizar o curso. " . mysqli_error($conn)
                ));
                return;
                break;
            }

            $res = atualizaVagasRemanescentes($id_curso, $conn);

            if($res['tipo'] == 'E'){
                echo json_encode($res);
                return;
                break;
            }

            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "Incricação Atualizada!.\nSeu email é o mesmo: ".$row['email']
            ));
            return;            
            break;
        }
        $mae = $_POST['mae'];
        $rg = $_POST['rg'];
        $uf = $_POST['uf'];
        $orgao = $_POST['orgao'];
        $dt_nasc = $_POST['dt_nasc'];
        $dt_expedi = $_POST['dt_expedi'];
        $nome_resp = $_POST['nome_resp'];
        $cpf_resp = $_POST['cpf_resp'];
        $periodo = $_POST['periodo'];
        $diassemana = $_POST['diassemana'];

        $email = $nome.$cpf."@etec.sp.gov.br";

        # Insere Inscrição
        $qry = "INSERT INTO `tb_inscricoes`(`id_inscricao`, `nome`, `cpf`, `mae`, `rg`, `uf`, `orgao`, `dt_nasc`, `dt_expedi`, `nome_resp`, `cpf_resp`, `periodo`, `diassemana`, `id_curso`, `email`) VALUES (default,'$nome','$cpf','$mae', '$rg', '$uf', '$orgao', '$dt_nasc', '$dt_expedi', '$nome_resp', '$cpf_resp', '$periodo', '$diassemana', '$id_curso', '$email')";

        if (!mysqli_query($conn, $qry)){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao inserir as informações da inscrição!" . mysqli_error($conn)
            ));
            return;
            break;
        }

        # Insere usuário
        $qry = "INSERT INTO `tb_usuarios` VALUES (default,'$email','00000')";

        if (!mysqli_query($conn, $qry)){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao inserir as informações do usuário!" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $res = atualizaVagasRemanescentes($id_curso, $conn);

        if($res['tipo'] == 'E'){
            echo json_encode($res);
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "Incricação feita!.\nSeu novo email é: $email e senha: 00000\nTroque de senha no primeiro acesso!"
        ));
        return;            
        break;

    case "checaCPF":
        $cpf = $_POST['cpf'];
        $qry = "SELECT * FROM `tb_inscricoes` WHERE cpf = '$cpf'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar o CPF. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        # Verifica se retornou conteudo
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $row = mysqli_fetch_assoc($resultset);
            echo json_encode(array(
                'tipo' => 'OK',
                'msg' => "",
                'nome' => $row['nome'],
                'mae' => $row['mae'],
                'rg' => $row['rg'],
                'uf' => $row['uf'],
                'orgao' => $row['orgao'],
                'dt_nasc' => $row['dt_nasc'],
                'dt_expedi' => $row['dt_expedi'],
                'cpf_resp' => $row['cpf_resp'],
                'nome_resp' => $row['nome_resp']
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => "",
            'nome' => '',
            'mae' => '',
            'rg' => '',
            'uf' => '',
            'orgao' => '',
            'dt_nasc' => '',
            'dt_expedi' => '',
            'cpf_resp' => '',
            'nome_resp' => ''
        ));
        return;            
        break;
}

function atualizaVagasRemanescentes($_id_curso, $conn){
    # Busca a quantidade atual de vagas para subtrair um 
    $qry = "select quantidade from tb_vagas where curso_id = '$_id_curso'";
    $resultset = mysqli_query($conn, $qry);

    # Verifica se deu certo a consulta
    if (!$resultset){
        return(array(
            'tipo' => 'E',
            'msg' => "Erro ao quantidade atual de vagas. " . $qry
        ));
    }

    # Verifica se retornou conteudo
    $qntd = mysqli_num_rows($resultset);
    if ($qntd > 0) {
        $row = mysqli_fetch_assoc($resultset);
        $qntdAtual = $row['quantidade'];

        # Atualiza a quantidade
        $qry = "update tb_vagas
        set quantidade = '$qntdAtual' - 1
        where curso_id = '$_id_curso'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            return(array(
                'tipo' => 'E',
                'msg' => "Erro ao Atualizar a quantidade de vagas. " . $qry
            ));
        }
        return(array(
            'tipo' => 'OK',
            'msg' => ""
        ));
    }else{
        return(array(
            'tipo' => 'E',
            'msg' => "Curso não encontrado. " . $qry
        ));
    }
}