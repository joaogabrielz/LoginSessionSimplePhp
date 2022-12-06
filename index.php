<?php

  include('conexao.php');

  if(isset($_POST['email']) || isset($_POST['senha'])){
    if(strlen($_POST['email']) == 0){
      echo "Preencha seu email";
    }
    else if(strlen($_POST['senha']) == 0){
      echo "Preencha sua senha";
    }
    else{
      // evitar Sql injection: ' ' OR 1 ='1' 
      // exemple: select * from usuarios where email = ( '' OR 1='1' )
      $email  = $mysqli->real_escape_string($_POST['email']);
      $senha  = $mysqli->real_escape_string($_POST['senha']);

      $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execuçaõ do codigo SQL : " . $mysqli->error);

      $qtd = $sql_query->num_rows;

      if($qtd == 1){
        $usuario = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
          session_start();
        } // valida mesmo apos trocar pagina, vale por um tempo, diferente de post ou get

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: painel.php");
      }
      else{
        echo 'Falha ao logar, Usuario ou Email incorretos..';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Acesse sua conta</h1>
  <form action="" method="POST">
    <p>
    <label for="">Email</label>
    <input type="email" name="email">
    </p>
    <p>
    <label for="">Senha</label>
    <input type="password" name="senha">
    </p>
    <p>
      <button type="submit" prevent>Entrar</button>
    </p>
  </form>
</body>
</html>