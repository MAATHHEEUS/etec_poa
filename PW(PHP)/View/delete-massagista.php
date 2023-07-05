<?php
include_once '../Controller/ControllerMassagistas.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $ControllerMassagistas = new ControllerMassagistas();
    if($ControllerMassagistas->deleteMassagista($id)){
        echo "<script>alert('REGISTRO EXCLUÍDO!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }else{
        echo "<script>alert('ERRO AO EXCLUIR!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }
}
?>