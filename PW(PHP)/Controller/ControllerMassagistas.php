<?php
include_once('../Model/crud.php');
include_once('../Model/validation.php');

class ControllerMassagistas{
    private $crud;
    private $validacao;

    public function __construct(){
        $this->crud = new Crud();
        $this->validacao = new Validation();
    }

    public function addMassagista(){
        if(isset($_POST['Submit'])){
            $nome = $this->crud->escape_string($_POST['nome']);
            $dataNasc = $this->crud->escape_string($_POST['dataNasc']);
            $contato = $this->crud->escape_string($_POST['contato']);

            $msg = $this->validacao->check_empty($_POST, array('nome', 'dataNasc', 'contato'));
            if($msg == null) {
                $result = $this->crud->execute("INSERT INTO massagista(nome, dataNasc, contato) VALUES('$nome', '$dataNasc', '$contato')");
                echo "MENSAGEM DE ADIÇÃO";
            }else{
                echo "MENSAGEM DE ERRO: $msg";
            }
        }
    }

    public function updateMassagista(){
        if(isset($_POST['Submit'])){
            $id = $_GET['id'];

            $nome = $this->crud->escape_string($_POST['nome']);
            $dataNasc = $this->crud->escape_string($_POST['dataNasc']);
            $contato = $this->crud->escape_string($_POST['contato']);

            $msg = $this->validacao->check_empty($_POST, array('nome', 'dataNasc', 'contato'));
            if($msg == null) {
                $result = $this->crud->execute("UPDATE massagista SET nome = '$nome', dataNasc = '$dataNasc', contato = '$contato' WHERE '$id'");

                if($result){
                    echo "MENSAGEM DE SUCESSO";
                }
                else{
                    echo "MENSAGEM DE ERRO";
                }
            }   
        }
    }   

    public function viewMassagistas(){
        $qry = "SELECT * FROM massagista ORDER BY 1";
        $result = $this->crud->getData($qry);
        return $result;
    }

    public function getMassagistaById($id){
        $id = $this->crud->escape_string($id);
        
        $qry = "SELECT * FROM massagista WHERE id = $id ORDER BY 1";
        $result = $this->crud->getData($qry);
        
        if(!empty($result)){
            return $result[0];
        }
        else{
            return null;
        }
    }

    public function deleteMassagista($id){
        $qry = "DELETE FROM massagista WHERE id = $id";
        $result = $this->crud->delete($qry);
        if($result) {
            return true;
        }else{
            return false;
        }
    }
}