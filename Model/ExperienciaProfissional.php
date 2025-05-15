<?php

class ExperienciaProfissioal{
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $empresa;
    private $descricao;


    // getters
    public function getId(){
        return $this->id;
    }
    public function getIdusuario(){
        return $this->idusuario;
    }
    public function getInicio(){
        return $this->inicio;
    }
    public function getFim(){
        return $this->fim;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function getDescricao(){
        return $this->descricao;
    }

    // setters
    public function setId($id){
        $this->id = $id;
    }
    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }
    public function setInicio($inicio){
        $this->inicio = $inicio;
    }
    public function setFim($fim){
        $this->fim = $fim;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }


    public function inserirBD(){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $this->idusuario, $this->inicio, $this->fim, $this->empresa, $this->descricao);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }


    public function excluirBD($id){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "DELETE FROM experienciaprofissional WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }

    public function listaExperiencias($idusuario){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "SELECT * FROM experienciaprofissional WHERE idusuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idusuario);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

    }

}

?>