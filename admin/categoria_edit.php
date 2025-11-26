<?php
session_start();
require("../db/conexao.php");
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Editar Categoria</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Editar categoria
                  <a href="categoria_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <?php if (isset($_GET['id'])) { 
                    $categoria_id = $_GET['id'];
                    $categoria = $pdo->query("SELECT id, nome, criado_em FROM categorias WHERE id = '$categoria_id';")->fetch();                    
                ?>
                <form action="categoria_action.php" method="POST">
                    <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-content" value="<?= $categoria['nome'] ?>" required>
                    </div>
                    <div class="mb-3">
                      <input type="submit" name="update_categoria" class="btn btn-primary" value="Salvar">
                    </div>                   
                </form>
                <?php } else { ?>
                    <h5>Categoria não encontrado!</h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>