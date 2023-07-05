<?php

include_once('../Model/crud.php');
include_once('../Model/validation.php');

class ControllerMassagem{
    private $crud;
    private $validacao;

    public function __construct(){
        $this->crud = new Crud();
        $this->validacao = new Validation();
    }

    public function addMassagem(){
        if(isset($_POST['Submit'])){
            $nome = $this->crud->escape_string($_POST['nome']);
            $valor = $this->crud->escape_string($_POST['valor']);
            $tipo = $this->crud->escape_string($_POST['tipo']);

            $msg = $this->validacao->check_empty($_POST, array('nome', 'valor', 'tipo'));
            if($msg == null) {
                $result = $this->crud->execute("INSERT INTO massagens(nome, valor, tipo) VALUES('$nome', '$valor', '$tipo')");
                echo "MENSAGEM DE ADIÇÃO";
                return;
            }else{
                echo "MENSAGEM DE ERRO: $msg";
                return;
            }
        }
    }

    public function updateMassagem(){
        if(isset($_POST['Submit'])){
            $id = $_GET['id'];

            $nome = $this->crud->escape_string($_POST['nome']);
            $valor = $this->crud->escape_string($_POST['valor']);
            $tipo = $this->crud->escape_string($_POST['tipo']);

            $msg = $this->validacao->check_empty($_POST, array('nome', 'valor', 'tipo'));
            if($msg == null) {
                $result = $this->crud->execute("UPDATE massagens SET nome = '$nome', valor = '$valor', tipo = '$tipo' WHERE id = '$id'");

                if($result){
                    echo "MENSAGEM DE SUCESSO";
                }
                else{
                    echo "MENSAGEM DE ERRO";
                }
            }   
        }
    }   

    public function viewMassagems(){
        $qry = "SELECT * FROM massagens ORDER BY 1";
        $result = $this->crud->getData($qry);
        
        return $result;
    }

    public function getMassagemById($id){
        $id = $this->crud->escape_string($id);
        
        $qry = "SELECT * FROM massagens WHERE id = $id ORDER BY 1";
        $result = $this->crud->getData($qry);
        
        if(!empty($result)){
            return $result[0];
        }
        else{
            return null;
        }
    }

    public function deleteMassagem($id){
        $qry = "DELETE FROM massagens WHERE id = $id";
        $result = $this->crud->delete($qry);
        if($result) {
            return true;
        }else{
            return false;
        }
    }
}