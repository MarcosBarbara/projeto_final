<?php

class OutrasFormacoes{
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    //getters    
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
            $sql = "INSERT INTO outrasformacoes (idusuario, inicio, fim, descricao) VALUES (?, ?, ?, ?)";
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
            $sql = "DELETE FROM outrasformacoes WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }

    public function listaFormacoes($idusuario) {
        require_once 'conexaoBD.php';
    
        $con = new ConexaoBD();
        $conn = $con->conectar();
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "SELECT * FROM outrasformacoes WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $idusuario);
            $stmt->execute();
    
            $result = $stmt->get_result();
    
            $lista = [];
            while ($row = $result->fetch_assoc()) {
                $formacao = new OutrasFormacoes();
                $formacao->id = $row['id'];
                $formacao->idusuario = $row['idusuario'];
                $formacao->inicio = $row['inicio'];
                $formacao->fim = $row['fim'];
                $formacao->descricao = $row['descricao'];
                $lista[] = $formacao;
            }
    
            $stmt->close();
            $conn->close();
    
            return $lista;
        } else {
            $conn->close();
            return [];
        }
    }
    
}

?>