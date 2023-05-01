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
    case 'carregaMaterias':
        $prof = mysqli_real_escape_string($conn, $_POST['prof']);
        
        # Busca as oportunidades
        $qry = "select * from tb_cursos where prof_id = ".$prof." order by nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as matérias. Contate o suporte com um print deste erro" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $materias = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Monta as matérias vinculadas ao professor
                $materias .= "<h2>" . $row['nome'] . " - (" . $row['periodo'] . ")</h2>";
                $materias .= '<div clas="noticia"><p>' . $row['resumo'] . '</p></div>';
                $materias .= '<div class="d-grid gap-2"><button class="btn btn-primary m-1 p-1" type="button" onclick="chamada('.$row['id_curso'].')">Chamada Diária</button></div><hr>';
                $contador++;
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA MATÉRIA ASSOCIADA AO PROFESSOR.!'
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'materias' => $materias,
            'msg' => ''
        ));
        return;            
        break;

    case "carregaChamada":
        $id_curso = mysqli_real_escape_string($conn, $_POST['id_curso']);

        #busca os alunos
        $qry = "select tb1.id_inscricao as num_inscricao, tb1.nome, tb1.cpf, tb1.mae, tb1.rg, tb1.uf, dt_nasc, tb1.nome_resp, tb1.cpf_resp, tb1.email,
tb2.nome as curso, tb2.resumo, tb2.tipo, tb2.periodo, tb2.diassemana
from tb_inscricoes tb1 join tb_cursos tb2 on tb2.id_curso = tb1.id_curso
where tb2.id_curso =" . $id_curso ." order by tb1.nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar os aluno da matéria. Contate o suporte com um print deste erro" . mysqli_error($conn)
            ));
            return;
            break;
        }

        $lista = "<table class='table table-hover table-light'>";

        #cabeçalho da lista
        $lista .= "<thead class=\"thead-dark\"><tr>
                    <th>Matrícula</th>
                    <th>Aluno</th>
                    <th>Data Nascimento</th>
                    <th>Presente</th>
                </tr></thead><tbody>";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Mosta lista de chamada
                $dtFormat = converteData('padrao', $row['dt_nasc']);

                $lista .= "<tr>
                            <td>".$row['num_inscricao']."</td>
                            <td>".$row['nome']."</td>
                            <td>".$dtFormat."</td>
                            <td><input type='checkbox'></input></td>
                        </tr>";
                $contador++;
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUM ALUNO INSCRITO NA MATÉRIA.!'
            ));
            return;            
            break;
        }

        $today = getdate();
        $dtAtual = $today['mday']."/".$today['mon']."/".$today['year'];
        $dtFormat = converteData('padrao', $dtAtual);

        $titulo = "<h4>Chamada do dia: ".$dtFormat."</h4>";

        echo json_encode(array(
            'tipo' => 'OK',
            'lista' => $lista,
            'titulo' => $titulo
        ));
        return;            
        break;
}