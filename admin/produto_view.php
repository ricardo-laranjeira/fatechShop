<?php require("../db/conexao.php"); ?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Visualizar Produto</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Visualizar produto
                  <a href="produto_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <?php if(isset($_GET['id'])){ 
                    $produto_id = $_GET['id'];
                    $produto = $pdo->query("SELECT id, fornecedor_id, categoria_id, nome, preco, quantidade, criado_em FROM produtos WHERE id = '$produto_id';")->fetch();
                ?>
                <div class="mb-3">
                    <label>Nome</label>
                    <p class="form-control"><?= $produto['nome'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Preço</label>
                    <p class="form-control"><?= $produto['preco'] ?></p>
                </div>
                <div class="mb-3">
                    <label>Quantidade</label>
                    <p class="form-control"><?= $produto['quantidade'] ?></p>
                </div>
                <div class="mb-3">
                    <select name="categoria_id" class="form-select" aria-label="Default select example">                        
                        <?php
                        $categoria_id = $produto['categoria_id'];
                        $categoria = $pdo->query("SELECT id, nome, criado_em FROM categorias WHERE id = '$categoria_id';")->fetch();                        
                        ?>      
                        <option selected disabled value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>                        
                      </select>
                </div>
                <div class="mb-3">
                    <select name="fornecedor_id" class="form-select" aria-label="Default select example">                        
                        <?php
                        $fornecedor_id = $produto['fornecedor_id'];
                        $fornecedor = $pdo->query("SELECT id, nome, email, telefone, criado_em FROM fornecedores WHERE id = '$fornecedor_id';")->fetch();                        
                        ?>      
                        <option selected disabled value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>                        
                      </select>
                </div>
                <?php } else { ?>
                    <h5>Produto não encontrado.</h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>