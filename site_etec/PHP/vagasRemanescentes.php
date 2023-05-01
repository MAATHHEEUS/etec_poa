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
    case 'carregaVagas':
        # Busca as vagas remanescentes
        $qry = "select * from tb_cursos where qtde_vagas <> 0 and excluido = 'N' order by nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as vagas remanescentes. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        $grid = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            # Monta a grid 
            $grid = "<table class='table table-hover table-light'>";
            $grid .= "<thead class=\"thead-dark\"><tr>";
            $grid .= "<th>Curso</th>";
            $grid .= "<th>Quantidade Vagas</th>";
            $grid .= "<th></th>";
            $grid .= "</tr></thead><tbody>";
            
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $grid .= "<tr>";
                $grid .= "<td>".$row['nome']."</td>";
                $grid .= "<td>".$row['qtde_vagas']."</td>";
                $grid .= "<td><button onclick=\"abrirDiv(".$row['id_curso'].")\" class='btn btn-danger m-1 btn-sm p-1'>INSCREVER-SE</button></td>";
                $grid .= "</tr>";

            }
            $grid .= "</tbody>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA VAGA REMANESCENTE CADASTRADA!'
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

    case 'dadosCurso':
        $id_curso = mysqli_real_escape_string($conn, $_POST['id_curso']);

        # Busca informações do curso
        $qry = "select * from tb_cursos where id_curso = '$id_curso'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar informações do curso" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $row = mysqli_fetch_assoc($resultset);

        $nome_curso = '<h4>Curso: ' . $row['nome'] . '</h4>';
        $resumo = '<p><strong>Resumo: </strong> ' . $row['resumo'] . '</p>';
        $requisitos = '<p><strong>Requisitos: </strong> ' . $row['requisitos'] . ' </p>';
        
        echo json_encode(array(
            'tipo' => 'OK',
            'id_curso' => $row['id_curso'],
            'nome_curso' => $nome_curso,
            'msg' => '',
            'resumo' => $resumo,
            'requisitos' => $requisitos,
            'periodo' => $row['periodo'],
            'tipo_curso' => $row['tipo'],
            'diassemana' => $row['diassemana'],
            'curso' => $row['nome']
        ));
        return;            
        break;
}