<?php

class FormacaoAcad{

    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
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
            $sql = "INSERT INTO formacaoAcademica (idusuario, inicio, fim, descricao) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $this->idusuario, $this->inicio, $this->fim, $this->descricao);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }

    public function excluirBD(){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "DELETE FROM formacaoAcademica WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }

    public function listaFormacoes($idusuario){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "SELECT * FROM formacaoAcademica WHERE idusuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idusuario);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
    }





}

?>