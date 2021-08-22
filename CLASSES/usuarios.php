<?php

class usuario
{
	private $pdo;
	public $smgErro = "";

	public function conectar ($nome, $host, $usuario, $senha)
	{
		global $pdo;
		global $msgErro;

		try {
		pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
		$msgErro = $e->getMessage();

		}
	
	}

	public function cadastrar($nome, $telefone, $email, $senha)
	{
		global $pdo;
		//verificar se ja existe usuario cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",email);
		$sql->execute(); //vai verificar no ID se o email informado corresponde ao cadastrado
		if($sql->rowCount() > 0)
		{
			return false; //ja esta cadastrado
		}
		else{
		//caso não, cadasta!
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
			$sql -> bindValue(":n", $nome);
            $sql -> bindValue(":t", $telefone);
            $sql -> bindValue(":e", $email);
            $sql -> bindValue(":s", md5($senha));
			$sql->execute();
			return true;
		}
	}

	public function logar($email, $senha)
	{
		global $pdo;
		//verificar se o email e senha estão cadastrados, se sim
		//entrar no sistema (sessão
		// verificação
        $sql = $pdo -> prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND  senha = :s");
        $sql -> bindValue(":e", $email);
        $sql -> bindValue(":s", md5($senha));
        $sql -> execute();
        //ao pesquisar o email e senha informara se a pessoa esta cadastrada ou não
        if ($sql -> rowCount() > 0){
            //iniciar sessão
            $dado = $sql -> fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //logado com sucesso
        } else {
            return false; //não foi possivel logar
        }
	)
	}
}

?>