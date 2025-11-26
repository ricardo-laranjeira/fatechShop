<?php
session_start();
require("../db/conexao.php");
$query = $pdo->prepare("SELECT id, nome, email, telefone, criado_em FROM fornecedores;");
$query->execute();
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Área Administrativa</title>
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
                <h4>Lista de fornecedores
                  <a href="fornecedor_create.php" class="btn btn-primary float-end">Adicionar fornecedor</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-borded table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Telefone</th>
                      <th>Criado em</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($fornecedor = $query->fetch()){ ?>
                    <tr>                      
                      <td><?= $fornecedor["id"] ?></td>
                      <td><?= $fornecedor["nome"] ?></td>
                      <td><?= $fornecedor["email"] ?></td>
                      <td><?= $fornecedor["telefone"] ?></td>
                      <td><?= $fornecedor["criado_em"] ?></td>
                      <td>
                        <a href="fornecedor_view.php?id=<?= $fornecedor['id'] ?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="fornecedor_edit.php?id=<?= $fornecedor['id'] ?>" class="btn btn-success btn-sm">Editar</a>
                        <form action="fornecedor_action.php" method="POST" class="d-inline">
                          <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_fornecedor" value="<?= $fornecedor['id'] ?>" class="btn btn-danger btn-sm">Excluir</button>
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