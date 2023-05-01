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
    case 'buscaProfessores':
        $qry = "select * from tb_usuarios WHERE tipo = 'prof' order by 1";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar os professores. Contate o suporte com um print deste erro!".$qry
            ));
            return;
            break;
        }

        $professores = "<";

        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $professores .= "<option value='".$row['usuario_id']."'>".$row['email']."</option>";
                $contador++;
            }
        }
        else{
            $professores .= "<option value=''>NENHUM PROFESSOR DISPONÍVEL</option>";
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'professores' => $professores,
            'msg' => ''
        ));
        return;            
        break;

    case 'buscar':
        # Busca todos os cursos
        $qry = "select tb1.id_curso, tb2.email as professor, tb1.nome as curso, tb1.tipo, tb1.periodo, tb1.diassemana, tb1.qtde_vagas
        from tb_cursos tb1 join tb_usuarios tb2 on tb2.usuario_id = tb1.prof_id WHERE tb1.excluido = 'N' order by tb1.tipo";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar os cursos. Contate o supoerte com um print deste erro!".$qry
            ));
            return;
            break;
        }

        $grid = "<table class='table table-hover table-light'>";

        #cabeçalho da lista
        $grid .= "<thead class=\"thead-dark\"><tr>
                    <th>Nome</th>
                    <th>Professor</th>
                    <th>Período</th>
                    <th>Tipo</th>
                    <th>Dias da Semana</th>
                    <th>Vagas</th>
                    <th>Ações</th>
                </tr></thead><tbody>";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $grid .= "<tr>
                            <td>".$row['curso']."</td>
                            <td>".$row['professor']."</td>
                            <td>".$row['periodo']."</td>
                            <td>".$row['tipo']."</td>
                            <td>".$row['diassemana']."</td>
                            <td>".$row['qtde_vagas']."</td>
                            <td><input type='button' class=\"btn btn-success m-1 btn-sm p-1\" value='EDITAR' onclick='Editar(".$row["id_curso"].")';><input type='button' class=\"btn btn-danger m-1 btn-sm p-1\"value='DELETAR' onclick='Deletar(".$row["id_curso"].")';></input></td>
                        </tr>";
                $contador++;
            }
            $grid .= "</tbody>";
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUM CURSO CADASTRADO!'
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
        $curso = mysqli_real_escape_string($conn, $_POST['curso']);

        # Atualiza o campo excluido
        $qry = "UPDATE `tb_cursos` SET `excluido` = 'S' WHERE id_curso = ".$curso;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao deletar curso. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'msg' => 'Curso Excluído com sucesso!'
        ));
        return;            
        break;

    case 'editar':
        $curso = mysqli_real_escape_string($conn, $_POST['curso']);

        # Busca os dados do usuario para edição
        $qry = "select * from tb_cursos WHERE excluido = 'N' and id_curso = ".$curso;
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao editar curso. Contate o suporte com print deste erro!" . $qry
            ));
            return;
            break;
        }
        $row = mysqli_fetch_assoc($resultset);

        $tipo = '';
        switch($row['tipo']){
            case 'Ensino Técnico':
                $tipo = 'tecnico';
                break;

            case 'Ensino Médio Técnico':
                $tipo = 'medio';
                break;
        }

        $dias_semana = '';
        switch($row['diassemana']){
            case 'Seg. a Sex.':
                $dias_semana = 'semana';
                break;

            case 'Sábados':
                $dias_semana = 'sabados';
                break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'nome' => $row['nome'],
            'resumo' => $row['resumo'],
            'requisitos' => $row['requisitos'],
            'tipo_curso' => $tipo,
            'vagas' => $row['qtde_vagas'],
            'periodo' => $row['periodo'],
            'dias_semana' => $dias_semana,
            'id' => $row['id_curso']
        ));
        return;            
        break;

    case 'salvar':
        $curso = mysqli_real_escape_string($conn, $_POST['id']);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $resumo = mysqli_real_escape_string($conn, $_POST['resumo']);
        $requisitos = mysqli_real_escape_string($conn, $_POST['requisitos']);
        $periodo = mysqli_real_escape_string($conn, $_POST['periodo']);
        $professor = mysqli_real_escape_string($conn, $_POST['professor']);
        $vagas = mysqli_real_escape_string($conn, $_POST['vagas']);

        $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
        switch($tipo){
            case 'tecnico':
                $tipo = 'Ensino Técnico';
                break;

            case 'medio':
                $tipo = 'Ensino Médio Técnico';
                break;
        }

        $dias_semana = mysqli_real_escape_string($conn, $_POST['dias_semana']);
        switch($dias_semana){
            case 'semana':
                $dias_semana = 'Seg. a Sex.';
                break;

            case 'sabados':
                $dias_semana = 'Sábados';
                break;
        }

        # Salva ou atualiza
        if($curso != ''){
            $qry = "UPDATE `tb_cursos` SET `nome` = '".$nome."', `tipo` = '".$tipo."', `resumo` = '".$resumo."', `requisitos` = '".$requisitos."', `periodo` = '".$periodo."', `diassemana` = '".$dias_semana."', `prof_id` = '".$professor."', `qtde_vagas` = '".$vagas."' WHERE id_curso = ".$curso;
            $msg = 'Curso atualizado!';
        }else{
            $qry = "INSERT INTO `tb_cursos`(`prof_id`, `nome`, `resumo`, `requisitos`, `periodo`, `diassemana`, `tipo`, `qtde_vagas`) VALUES ('".$professor."', '".$nome."', '".$resumo."', '".$requisitos."', '".$periodo."', '".$dias_semana."', '".$tipo."', '".$vagas."')";
            $msg = 'Curso cadastrado.';
        }
        
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao salvar Curso. Contate o suporte com print deste erro!" . $qry
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