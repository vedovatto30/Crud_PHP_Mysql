<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario();
define('host_name', 'localhost');
define('host_user', 'root');
define('host_pwd', "");
define('db_name', 'projeto_login');
?>

<html lang="pt-br">
<head>
  <meta charset="utf-8"/> 
  <title>Projeto Login</title>
  <link rel="stylesheet"  href="css/stilo.css">
</head>
<body>
	<div id="corpo-form-cad">
	<h1>Cadastrar</h1>
    <form method="POST">
    	<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
    	<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
    	<input type="email" name="email" placeholder="Email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
        <input type="submit" value="Cadastrar">
    </form>
</div>
<?php
//verificar se o usuario clicou no botão
  if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);  //o addslashes é um metodo de evitar acessos maliciosos dos dados
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confSenha = addslashes($_POST['confSenha']);

        //verificar se esta preenchido
        if (!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
        {
            $u -> conectar(db_name, host_name,host_user,host_pwd);
            
            if ($u -> msgErro == ""){ //esta tudo certo
                if ($senha == $confSenha) //conferir se senha e confSenha
                {
                    if($u -> cadastrar($nome, $telefone, $email, $senha, $confSenha))
                    {
                      ?>
                      <div id="msg-sucesso">"Email cadastrado com sucesso"</div>
                      <?php
                    }else 
                      {
                      ?>
                      <div class="msg-erro">"Este email já foi usado"</div>
                      <?php
                      }
                } else 
                  {
                    ?>
                    <div class="msg-erro">"As senhas não são iguais"</div>
                    <?php
                 }
            }else {
                ?>
                <div class="msg-erro">
                    <?php echo "ERRO: " . $u-> $msgErro; ?>
                  
                </div>
              
            
</body>
</html>