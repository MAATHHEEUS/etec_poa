<?php
$servidor = "sql101.epizy.com";
$banco = "epiz_33834181_tcc";
$usuario = "epiz_33834181";
$senha = "sF1ibFhD6h";
$porta = "3306";

$conn = mysqli_connect($servidor, $usuario, $senha, $banco, $porta);

if (!$conn) {
    $conect = false;
    $error = mysqli_connect_error();
}
else{
    $conect = true;
}

# Define o CHARSET
$qry = "SET CHARACTER SET utf8";

if (!mysqli_query($conn, $qry)){
    echo json_encode(array(
        'tipo' => 'E',
        'msg' => "Erro ao inserir as configurações de CharSet" . mysqli_error($conn)
    ));
    return;
}

mysqli_set_charset($conn, "utf8mb4");

/**
* Converte a data passada para o formato passado(sql, padrao), se data nao passada busca a data atual
* parameters: $format - ('SQL', 'padrao'); $data - ('dd/mm/aa', 'aaaa-mm-dd')
* returns: data formata
*/
function converteData($format = '', $data = ''){
    if($data == ''){
        $today = getdate();
        $data = $today['mday']."/".$today['mon']."/".$today['year'];
    }
    # Formata para SQL aa-mm-dd
    if(strtoupper($format) == 'SQL'){
        $aux = explode('/', $data);
        if($aux[2]){
          $dataSQL = $aux[2]."-".$aux[1]."-".$aux[0];
          return $dataSQL;
        }else{
        	return $data;
        }
    }
    # Formata para o padrão dd/mm/aa
    else{
        $aux = explode('-', $data);
        if($aux[2]){
            $dataPadrao = $aux[2]."/".$aux[1]."/".$aux[0];
            return $dataPadrao;
        }
        else{
            return $data;
        }
    }
}

/**
* Devolve o numero padrão setado para quantidade de notícias que aparecerá na tela principal
* returns: inteiro
*/
function getQuantidadeNoticias() {
    return 2;
}