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
    case 'carregaCursos':
        # Busca as materias do professor/Usuario
        $qry = "select * from tb_cursos order by nome";
        $resultset = mysqli_query($conn, $qry);

        # Verifica se deu certo a consulta
        if (!$resultset){
            echo json_encode(array(
                'tipo' => 'E',
                'msg' => "Erro ao consultar os cursos."
            ));
            return;
            break;
        }

        $list_box_cursos = '<option value="">TODOS</option>';
        # Verifica se retornou linhas
        $qntd = mysqli_num_rows($resultset);
        if ($qntd > 0) {
            while($row = mysqli_fetch_assoc($resultset)){
                # cursos
                $list_box_cursos .= '<option value="'.$row['id_curso'].'">'.$row['nome'].'</option>';
            }
        }

        echo json_encode(array(
            'tipo' => 'OK',
            'cursos' => $list_box_cursos,
            'msg' => ''
        ));
        return;            
        break;

}