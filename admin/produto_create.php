<?php
require("../db/conexao.php");
$query1 = $pdo->prepare("SELECT id, nome FROM categorias;");
$query1->execute();

$query2 = $pdo->prepare("SELECT id, nome, email, telefone, criado_em FROM fornecedores;");
$query2->execute();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Cadastrar Produto</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Adicionar produto
                  <a href="produto_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <form action="produto_action.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-content" placeholder="Nome" required>
                    </div>
                    <div class="mb-3">
                        <label>Preço</label>
                        <input type="text" name="preco" class="form-content" placeholder="15.99" required>
                    </div>
                    <div class="mb-3">
                        <label>Quantidade</label>
                        <input type="text" name="quantidade" class="form-content" placeholder="152" required>
                    </div>
                    <div class="mb-3">
                      <select name="categoria_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>Selecione a categoria</option>
                        <?php 
                        while ($categoria = $query1->fetch()) {
                        ?>      
                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <select name="fornecedor_id" class="form-select" aria-label="Default select example">
                        <option value="" selected>Selecione o fornecedor</option>
                        <?php 
                        while ($fornecedor = $query2->fetch()) {
                        ?>      
                        <option value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input type="submit" name="create_produto" class="btn btn-primary" value="Salvar">
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>