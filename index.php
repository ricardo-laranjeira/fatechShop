<?php
require("db/conexao.php");
$query = $pdo->prepare("SELECT * FROM produtos;");
$query->execute();
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fatecshop - Home</title>
    <link href="bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <?php include("navbar.php"); ?>
    <div class="container">
      <div class="row">
        <?php 
        while ($produto = $query->fetch()) {
        ?>
          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text"><?= $produto['nome'] ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <script src="bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>