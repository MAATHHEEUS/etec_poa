<?php
include_once '../Controller/ControllerAgendamentos.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $ControllerAgendamentos = new ControllerAgendamentos();

    if($ControllerAgendamentos->deleteAgendamento($id)){
        echo "<script>alert('REGISTRO EXCLUÍDO!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }else{
        echo "<script>alert('ERRO AO EXCLUIR!');window.open('http://pwiii.lovestoblog.com/','_self');</script>";
    }
}
?>