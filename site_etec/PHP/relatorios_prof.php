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
        # Busca as materias do professor/Usuario
        $qry = "select * from tb_cursos where prof_id = ".$prof." order by nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar as matérias do Professor."
            ));
            return;
            break;
        }

        $list_box_materias = "";
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            $contador = 0;
            while($row = mysqli_fetch_assoc($resultset)){
                # Times
                $list_box_materias .= '<option value="'.$row['id_curso'].'">'.$row['nome'].'</option>';
                $contador++;
            }
        }
        else{
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => 'NENHUMA MATÉRIA ATRIBUIDA AO PROFESSOR'
            ));
            return;            
            break;
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'materias' => $list_box_materias,
            'msg' => ''
        ));
        return;            
        break;

}