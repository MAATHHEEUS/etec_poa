<?php
$servidor = "localhost";
$banco = "tcc";
$usuario = "root";
$senha = "";
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