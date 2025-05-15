<?php

class ConexaoBD{
    private $serverName = "localhost";
    private $userName = "root";
    private $pssword = ""; //usbw
    private $dbName = "projeto_final";

    public function conectar(){
        $conn = new mysqli($this->serverName, $this->userName, $this->pssword, $this->dbName);
        return $conn;
    }
}

?>