<?php
if(!isset($_SESSION))
{
	session_start();
}

//--Atualizar--//
case isset($_POST["btnAtualizar"]):
	require_once "../Controller/UsuarioController.php";
	$uController = new UsuarioController();
if ($uController->atualizar(
	$_POST["txtID"],
	$_POST["txtNome"],
	$_POST["txtCPF"],
	$_POST["txtEmail"],
	date("Y-m-d", strtotime($_POST["txtData"]))
)
) {
include_once "../View/atualizacaoRealizada.php";
} else {
include_once "../View/operacaoNaoRealizada.php";
}
break;

class UsuarioController{
	public function inserir($nome, $cpf, $email,$senha) {
		require_once '../Model/Usuario.php';
		$usuario = new Usuario();
		$usuario->setNome($nome);
		$usuario->setCPF($cpf);
		$usuario->setEmail($email);
		$usuario->setSenha($senha);
		$r = $usuario->inserirBD();
		$_SESSION['Usuario'] = serialize($usuario);
	return $r;
	}

	public function atualizar($id, $nome, $cpf, $email, $dataNascimento) {
		require_once '../Model/Usuario.php';
		$usuario = new Usuario();
		$usuario->setId($id);
		$usuario->setNome($nome);
		$usuario->setCPF($cpf);
		$usuario->setEmail($email);
		$usuario->setDataNascimento($dataNascimento);
		$r = $usuario->atualizarBD();
		$_SESSION['Usuario'] = serialize($usuario);
return $r;
	}

	public function login($cpf, $senha){
		require_once '../Model/Usuario.php';
		$usuario = new Usuario();
		$usuario->carregarUsuario($cpf);
		$verSenha=$usuario->getSenha();
if($senha==$verSenha)
{
$_SESSION['Usuario'] = serialize($usuario);
return true;
}
else
{
return false;
}
}
	
}

?>
