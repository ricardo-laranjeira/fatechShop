<?php
session_start();
require("../db/conexao.php");
$query = $pdo->prepare("SELECT id, fornecedor_id, categoria_id, nome, preco, quantidade, criado_em FROM produtos;");
$query->execute();
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Área Admnistrativa</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-4">
        <?php include("mensagem.php"); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Lista de produtos
                  <a href="produto_create.php" class="btn btn-primary float-end">Adicionar produto</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-borded table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Preço</th>
                      <th>Quantidade</th>
                      <th>Criado em</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($produto = $query->fetch()){ ?>
                    <tr>                      
                      <td><?= $produto["id"] ?></td>
                      <td><?= $produto["nome"] ?></td>
                      <td><?= $produto["preco"] ?></td>
                      <td><?= $produto["quantidade"] ?></td>
                      <td><?= $produto["criado_em"] ?></td>
                      <td>
                        <a href="produto_view.php?id=<?= $produto['id'] ?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="produto_edit.php?id=<?= $produto['id'] ?>" class="btn btn-success btn-sm">Editar</a>
                        <form action="produto_action.php" method="POST" class="d-inline">
                          <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_produto" value="<?= $produto['id'] ?>" class="btn btn-danger btn-sm">Excluir</button>
                        </form>                        
                      </td>                       
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>