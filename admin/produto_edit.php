<?php
session_start();
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
  <title>Fatecshop - Editar Produto</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Editar produto
                  <a href="produto_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <?php if (isset($_GET['id'])) { 
                    $produto_id = $_GET['id'];
                    $produto = $pdo->query("SELECT id, fornecedor_id, categoria_id, nome, preco, quantidade, criado_em FROM produtos WHERE id = '$produto_id';")->fetch();                    
                ?>
                <form action="produto_action.php" method="POST">
                    <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-content" value="<?= $produto['nome'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Preço</label>
                        <input type="text" name="preco" class="form-content" value="<?= $produto['preco'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Quantidade</label>
                        <input type="text" name="quantidade" class="form-content" value="<?= $produto['quantidade'] ?>" required>
                    </div>                    
                    <div class="mb-3">
                      <select name="categoria_id" class="form-select" aria-label="Default select example">
                        <option value="">Selecione a categoria</option>
                        <?php 
                        while ($categoria = $query1->fetch()) {
                            if($produto['categoria_id'] == $categoria['id']){
                                ?>
                                <option selected value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                            <?php
                            } else {                                
                                ?>
                                <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                            <?php
                            }
                        ?>      
                        
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <select name="fornecedor_id" class="form-select" aria-label="Default select example">
                        <option value="">Selecione o fornecedor</option>
                        <?php 
                        while ($fornecedor = $query2->fetch()) {
                            if($produto['fornecedor_id'] == $fornecedor['id']){
                                ?>
                                <option selected value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                            <?php
                            } else {                                
                                ?>
                                <option value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                            <?php
                            }
                        ?>      
                        
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input type="submit" name="update_produto" class="btn btn-primary" value="Salvar">
                    </div>
                </form>
                <?php } else { ?>
                    <h5>Produto não encontrado!</h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>