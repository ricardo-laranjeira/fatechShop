<?php
require("db/conexao.php");
//session_start();

if (isset($_POST['submit'])){
  if (!empty($_POST['email']) && !empty($_POST['senha'])){
    $email = test_input($_POST['email']);
    $senha = test_input($_POST['senha']);

    $user = $pdo->query("SELECT id, nome, senha FROM usuarios WHERE email = '$email';")->fetch();
    
    if (password_verify($senha, $user['senha'])) {
      header('Location: admin/home.php');
      exit;
    } else {
        //$_SESSION['error'] = "Email ou senha inválido";
        echo "Email ou senha inválidos.";
    }    
  } else {
    echo "Preencher email e senha.";
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fatecshop - Login</title>
    <link href="bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="css/signin.css" rel="stylesheet">
  </head>  
  <body class="text-center">    
    <main class="form-signin">
        <form action="login.php" method="POST" autocomplete="off">
            <h1 class="h3 mb-3 fw-normal">Entrar</h1>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Senha</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Lembrar-me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2025</p>
        </form>
    </main>
    <script src="bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>