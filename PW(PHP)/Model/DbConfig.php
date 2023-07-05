<?php
class DbConfig
{
    private $host = 'sql100.epizy.com';
    private $username = 'epiz_33696059';
    private $password = 'lfxwjrmKnjktZz4';
    private $database = 'epiz_33696059_poo';
    protected $connection;

    public function __construct()
    {
        if (!isset($this->connection)) {
            $this->connection = new mysqli('sql100.epizy.com', 'epiz_33696059', 'lfxwjrmKnjktZz4', 'epiz_33696059_poo');
            
            if  (!$this->connection) {
                echo 'Não é possivel conectar ao servidor de banco de dados';
                exit;
            }
        }
    }
}
?>