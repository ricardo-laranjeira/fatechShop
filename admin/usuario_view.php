<?php require("../db/conexao.php"); ?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Visualizar Usuário</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Visualizar usuário
                  <a href="usuario_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <?php if(isset($_GET['id'])){ 
                    $usuario_id = $_GET['id'];
                    $user = $pdo->query("SELECT id, nome, email, senha, criado_em FROM usuarios WHERE id = '$usuario_id';")->fetch();
                ?>
                <div class="mb-3">
                    <label>Nome</label>
                    <p class="form-control"><?= $user['nome'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <p class="form-control"><?= $user['email'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Senha</label>
                    <p class="form-control"><?= $user['senha'] ?></p>
                </div>
                <?php } else { ?>
                    <h5>Usuário não encontrado.</h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>