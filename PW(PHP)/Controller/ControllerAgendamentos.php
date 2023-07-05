<?php
include_once('../Model/crud.php');
include_once('../Model/validation.php');

class ControllerAgendamentos{
    private $crud;
    private $validacao;

    public function __construct(){
        $this->crud = new Crud();
        $this->validacao = new Validation();
    }

    public function buscaMassagistas() {
        $qry = "SELECT * FROM massagista ORDER BY 1";
        $massagistas = $this->crud->getData($qry);

        $listBox = '';
        foreach ($massagistas as $massagista) {
            $listBox .= "<option value='".$massagista['id']."'>".$massagista['nome']." - ".$massagista['contato']."</option>";
        }

        if($listBox == ''){
            $listBox = "<option value=''>Ainda não há massagistas cadastrados!</option>";
        }
        return $listBox;
    }

    public function buscaMassagens() {
        $qry = "SELECT * FROM massagens ORDER BY 1";
        $massagens = $this->crud->getData($qry);
        
        $listBox = '';
        foreach ($massagens as $massagen) {
            $listBox .= "<option value='".$massagen['id']."'>".$massagen['nome']." - ".$massagen['tipo']." - ".$massagen['valor']."</option>";
        }

        if($listBox == ''){
            $listBox = "<option value=''>Ainda não há massagens cadastradas!</option>";
        }
        return $listBox;
    }

    public function addAgendamento(){
        if(isset($_POST['Submit'])){
            $id_massagista = $this->crud->escape_string($_POST['id_massagista']);
            $id_massagem = $this->crud->escape_string($_POST['id_massagem']);
            $data_hr = $this->crud->escape_string($_POST['data_hr']);

            $msg = $this->validacao->check_empty($_POST, array('id_massagista', 'id_massagem', 'data_hr'));
            if($msg == null) {
                $result = $this->crud->execute("INSERT INTO agendamentos(id_massagista, id_massagem, data_hr) VALUES('$id_massagista', '$id_massagem', '$data_hr')");
                echo "MENSAGEM DE ADIÇÃO";
                return;
            }else{
                echo "MENSAGEM DE ERRO: $msg";
                return;
            }
        }
    }

    public function updateAgendamento(){
        if(isset($_POST['Submit'])){
            $id = $_GET['id'];
            $id_massagista = $this->crud->escape_string($_POST['id_massagista']);
            $id_massagem = $this->crud->escape_string($_POST['id_massagem']);
            $data_hr = $this->crud->escape_string($_POST['data_hr']);

            $msg = $this->validacao->check_empty($_POST, array('id_massagista', 'id_massagem', 'data_hr'));
            if($msg == null) {
                $result = $this->crud->execute("UPDATE agendamentos SET id_massagista = '$id_massagista', id_massagem = '$id_massagem', data_hr = '$data_hr' WHERE id = '$id'");

                if($result){
                    echo "MENSAGEM DE SUCESSO";
                }
                else{
                    echo "MENSAGEM DE ERRO";
                }
            }   
        }
    }   

    public function viewAgendamentos(){
        $qry = "SELECT tb1.id, tb1.data_hr, tb2.nome as massagista, tb2.contato, tb3.nome as massagem, tb3.valor
        FROM agendamentos tb1 JOIN massagista tb2 ON tb2.id = tb1.id_massagista
        JOIN massagens tb3 ON tb3.id = tb1.id_massagem";
        $result = $this->crud->getData($qry);
        return $result;
    }

    public function getAgendamentoById($id){
        $id = $this->crud->escape_string($id);
        
        $qry = "SELECT * FROM agendamentos WHERE id = $id ORDER BY 1";
        $result = $this->crud->getData($qry);
        
        if(!empty($result)){
            return $result[0];
        }
        else{
            return null;
        }
    }

    public function deleteAgendamento($id){
        $qry = "DELETE FROM agendamentos WHERE id = $id";
        $result = $this->crud->delete($qry);
        if($result) {
            return true;
        }else{
            return false;
        }
    }
}