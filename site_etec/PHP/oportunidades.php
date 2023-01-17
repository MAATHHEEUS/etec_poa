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
    case 'carregaOportunidades':
        # Busca as oportunidades
        $qry = "select * from tb_oportunidades order by nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as oportunidades. " . mysqli_error($conn)
            ));
            return;
            break;
        }

        $grid = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            # Monta a grid 
            $grid = "<table class='table table-holver table-striped table-bordered'>";
            $grid .= "<tr>";
            $grid .= "<th>Nome</th>";
            $grid .= "<th>Área</th>";
            $grid .= "<th>Empresa</th>";
            $grid .= "<th></th>";
            $grid .= "</tr>";
            
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $grid .= "<tr>";
                $grid .= "<td>".$row['nome']."</td>";
                $grid .= "<td>".$row['area']."</td>";
                $grid .= "<td>".$row['empresa']."</td>";
                $grid .= "<td><button onclick=\"abrirDiv(".$row['oportunidade_id'].")\" class='btn btn-danger'>Informações</button></td>";
                $grid .= "</tr>";

            }
            $grid .= "</tr>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA VAGA DE ESTÁGIO OU BOLSA DISPONÍVEL NO MOMENTO.!'
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

    case 'dadosOportunidade':
        $id_oportunidade = $_POST['id_oportunidade'];

        # Busca informações do curso
        $qry = "select * from tb_oportunidades where oportunidade_id = '$id_oportunidade'";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar informações da oportunidade" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $row = mysqli_fetch_assoc($resultset);

        $nome = '<h4>' . $row['tipo'] . ': ' . $row['nome'] . '</h4>';
        $resumo = '<p><strong>Resumo: </strong> ' . $row['resumo'] . '</p>';
        $requisitos = '<p><strong>Requisitos: </strong> ' . $row['requisitos'] . ' </p>';
        $link = '<strong>Site para inscrição: </strong><a href="https://' . $row['site'] . '" target="_blank" class="sem_linha">' . $row['site'] . '</a>';

        echo json_encode(array(
            'tipo' => 'OK',
            'nome' => $nome,
            'msg' => '',
            'resumo' => $resumo,
            'requisitos' => $requisitos,
            'link' => $link,
            'contato' => $row['contato'],
            'empresa' => $row['empresa'],
            'area' => $row['area']
        ));
        return;            
        break;
}