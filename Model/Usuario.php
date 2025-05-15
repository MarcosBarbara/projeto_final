<?php
class Usuario{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha;

    // getters
    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDataNascimento(){
        return $this->dataNascimento;
    }

    public function getSenha(){
        return $this->senha;
    }

    // setters
    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function inserirBD(){
        require_once 'conexaoBD.php';

        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "INSERT INTO usuario (nome, cpf, email, dataNascimento, senha) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $this->nome, $this->cpf, $this->email, $this->dataNascimento, $this->senha);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }   
    }

    public function carregarUsuario($cpf){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "SELECT * FROM usuario WHERE cpf = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cpf);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->nome = $row['nome'];
            $this->cpf = $row['cpf'];
            $this->email = $row['email'];
            $this->dataNascimento = $row['dataNascimento'];
            $this->senha = $row['senha'];
            $stmt->close();
            $conn->close();
        }   
    }

    public function atualizarBD(){
        require_once 'conexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "UPDATE usuario SET nome = ?, email = ?, dataNascimento = ? WHERE cpf = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $this->nome, $this->email, $this->dataNascimento, $this->cpf);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }   
    }




}
?>