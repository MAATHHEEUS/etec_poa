<?php
include_once '../Controller/ControllerMassagem.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $MassagemController = new ControllerMassagem();

    if($MassagemController->deleteMassagem($id)){
        echo "<script>alert('REGISTRO EXCLUÍDO!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }else{
        echo "<script>alert('ERRO AO EXCLUIR!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }
}
?>