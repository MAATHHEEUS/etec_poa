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
        $qry = "select * from tb_oportunidades WHERE excluido = 'N' order by tipo";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as oportunidades. Contate o suporte com um print deste erro!".$qry
            ));
            return;
            break;
        }

        $grid = "<table class='table table-hover table-light'>";

        #cabeçalho da lista
        $grid .= "<thead class=\"thead-dark\"><tr>
                    <th>Nome</th>
                    <th>Site</th>
                    <th>Contato</th>
                    <th>Empresa</th>
                    <th>Área</th>
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
                            <td>".$row['nome']."</td>
                            <td>".$row['site']."</td>
                            <td>".$row['contato']."</td>
                            <td>".$row['empresa']."</td>
                            <td>".$row['area']."</td>
                            <td>".$row['tipo']."</td>
                            <td><input type='button'' class=\"btn btn-success m-1 btn-sm p-1\" value='EDITAR' onclick='Editar(".$row["oportunidade_id"].")';><input type='button'' class=\"btn btn-danger m-1 btn-sm p-1\" value='DELETAR' onclick='Deletar(".$row["oportunidade_id"].")';></input></td>
                        </tr>";
                $contador++;
            }
            $grid .= "</tbody>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA OPORTUNIDADE CADASTRADA!'
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
        $oportunidade = mysqli_real_escape_string($conn, $_POST['oportunidade']);

        # Atualiza o campo excluido
        $qry = "UPDATE `tb_oportunidades` SET `excluido` = 'S' WHERE oportunidade_id = ".$oportunidade;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao deletar oportunidade. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Oportunidade excluída com sucesso!'
        ));
        return;            
        break;

    case 'editar':
        $oportunidade = mysqli_real_escape_string($conn, $_POST['oportunidade']);

        # Busca os dados do usuario para edição
        $qry = "select * from tb_oportunidades WHERE excluido = 'N' and oportunidade_id = ".$oportunidade;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao editar oportunidade. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }
        $row = mysqli_fetch_assoc($resultset);

        echo json_encode(array(
            'tipo' => 'OK',
            'nome' => $row['nome'],
            'empresa' => $row['empresa'],
            'contato' => $row['contato'],
            'requisitos' => $row['requisitos'],
            'resumo' => $row['resumo'],
            'site' => $row['site'],
            'area' => $row['area'],
            'tipo_oportunidade' => $row['tipo'],
            'id' => $row['oportunidade_id']
        ));
        return;            
        break;

    case 'salvar':
        $oportunidade = mysqli_real_escape_string($conn, $_POST['id']);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $empresa = mysqli_real_escape_string($conn, $_POST['empresa']);
        $contato = mysqli_real_escape_string($conn, $_POST['contato']);
        $requisitos = mysqli_real_escape_string($conn, $_POST['requisitos']);
        $resumo = mysqli_real_escape_string($conn, $_POST['resumo']);
        $site = mysqli_real_escape_string($conn, $_POST['site']);
        $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);

        # Salva ou atualiza
        if($oportunidade != ''){
            $qry = "UPDATE `tb_oportunidades` SET `nome` = '".$nome."', `tipo` = '".$tipo."', `site` = '".$site."', `empresa` = '".$empresa."', `contato` = '".$contato."', `requisitos` = '".$requisitos."', `resumo` = '".$resumo."' WHERE oportunidade_id = ".$oportunidade;
            $msg = 'Oportunidade atualizada!';
        }else{
            $qry = "INSERT INTO `tb_oportunidades`(`nome`, `site`, `tipo`, `empresa`, `contato`, `requisitos`, `resumo`) VALUES ('".$nome."', '".$site."', '".$tipo."', '".$empresa."', '".$contato."', '".$requisitos."', '".$resumo."')";
            $msg = 'Oportunidade cadastrada!';
        }
        
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar Oportunidade. Contate o suporte com print deste erro!" . $qry
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