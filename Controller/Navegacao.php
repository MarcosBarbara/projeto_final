<?php 
if(!isset($_SESSION))
{
session_start();
}

switch ($_POST) {
//Caso a variavel seja nula mostrar tela de login
case isset($_POST[null]):
include_once "View/login.php";
break;
//---Primeiro Acesso--//
case isset($_POST["btnPrimeiroAcesso"]):
include_once "../View/primeiroAcesso.php";
break;
}

//---Cadastrar--//
case isset($_POST["btnCadastrar"]):
require_once "../Controller/UsuarioController.php";
$uController = new UsuarioController();
if ($uController->inserir(
$_POST["txtNome"],
$_POST["txtCPF"],
$_POST["txtEmail"],
$_POST["txtSenha"]
))
{
include_once "../View/cadastroRealizado.php";
} else {
include_once "../View/cadastroNaoRealizado.php";
}
break; 


?>