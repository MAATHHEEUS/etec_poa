<?php
include_once '../Model/DbConfig.php';

class Crud extends DbConfig
{
    public function __construct()
    {
        parent :: __construct();
    }

    public function escape_string($value)
    {
        return $this->connection-> real_escape_string($value);
    }

    public function execute($query)
    {
        $result = $this->connection->query($query);

       if ($result === false) {
           /*tratamento de erros usando a estrutura "throw new Exception
           para lançar nova exceção () em caso de erro na consulta  SQL.
    */       throw new Exception('Error: ' . $this->connection->error);
       } 

       return true;
    }

    public  function getData($query){
        $result = $this->connection->query($query);

        if ($result === false) {
            /* tratamento de erros usando a estrutura "throw new Exception
           para lançar nova exceção () em caso de erro na consulta  SQL.
    */       throw new Exception('Error: ' . $this->connection->error);
        } 
        $rows = array();
        
        while ($row = $result->fetch_assoc()) {
           $rows[] = $row;
        }
        return $rows;
    }

    public function delete($query)
    {
        $result = $this->connection->query($query);  
        /* tratamento de erros usando a estrutura "throw new Exception
            para lançar nova exceção () em caso de erro na consulta  SQL. */
        if ($result === false) {
            throw new Exception('Error: ' . $this->connection->error);
        }
        return true;
    }

    public function update($query)
    {
        $result = $this->connection->query($query);  
        /* tratamento de erros usando a estrutura "throw new Exception
           para lançar nova exceção () em caso de erro na consulta  SQL. */
        if ($result === false) {
            throw new Exception('Error: ' . $this->connection->error);
        }
        return true;
    }
}
?>