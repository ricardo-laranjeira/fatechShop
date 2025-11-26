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
                <h4>Visualizar fornecedor
                  <a href="fornecedor_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <?php if(isset($_GET['id'])){ 
                    $fornecedor_id = $_GET['id'];
                    $fornecedor = $pdo->query("SELECT id, nome, email, telefone, criado_em FROM fornecedores WHERE id = '$fornecedor_id';")->fetch();
                ?>
                <div class="mb-3">
                    <label>Nome</label>
                    <p class="form-control"><?= $fornecedor['nome'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <p class="form-control"><?= $fornecedor['email'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Telefone</label>
                    <p class="form-control"><?= $fornecedor['telefone'] ?></p>
                </div>
                <?php } else { ?>
                    <h5>Fornecedor não encontrado.</h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>