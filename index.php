<?php
require_once 'CLASSES/usuarios.php';
$user = new Usuario();
define('host_name', 'localhost');
define('host_user', 'root');
define('host_pwd', "").
define('db_name', 'projeto_login');
?>
<html lang="pt-br">
<head>
  <meta charset="utf-8"/> 
  <title>Projeto Login</title>
  <link rel="stylesheet"  href="css/stilo.css">
</head>
<body>
	<div id="corpo-form">
	<h1>Entrar</h1>
    <form method="POST">
    	<input type="email" placeholder="Usuario" name="email">
        <input type="password" placeholder="Senha" name="senha">
        <input type="submit" value="ACESSAR">
        <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se</strong></a>
    </form>
</div>
<?php
 if(isset($_POST['email']))
    {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if (!empty($email) && !empty($senha))
     {
        $u -> conectar(db_name, host_name,host_user,host_pwd);
        if ($u -> msgErro == ""){
            if($u -> logar($email, $senha)){
                header("location: areaPrivada.php");
            } else {
                ?>
                <div class="msg-erro"> Email ou Senha estão incorretos </div>
            <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                <?php
                echo "ERRO: " . $u -> msgErro;
                ?>
            </div>
        <?php
        }

    }else {
        ?>
        <div class="msg-erro"> Por gentileza. Preencha os dois campos </div>
    <?php
        }
    }
?>
</body>
</html>
