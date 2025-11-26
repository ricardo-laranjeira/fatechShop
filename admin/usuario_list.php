<?php
session_start();
require("../db/conexao.php");
$query = $pdo->prepare("SELECT id, nome, email, senha, criado_em FROM usuarios;");
$query->execute();
// PS C:\php> php -S localhost:8000 -t C:\php\www\fatecshop\
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop</title>
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
                <h4>Lista de usuários
                  <a href="usuario_create.php" class="btn btn-primary float-end">Adicionar usuário</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-borded table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Senha</th>
                      <th>Criado em</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($usuario = $query->fetch()){ ?>
                    <tr>                      
                      <td><?= $usuario["id"] ?></td>
                      <td><?= $usuario["nome"] ?></td>
                      <td><?= $usuario["email"] ?></td>
                      <td><?= $usuario["senha"] ?></td>
                      <td><?= $usuario["criado_em"] ?></td>
                      <td>
                        <a href="usuario_view.php?id=<?= $usuario['id'] ?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="usuario_edit.php?id=<?= $usuario['id'] ?>" class="btn btn-success btn-sm">Editar</a>
                        <form action="usuario_action.php" method="POST" class="d-inline">
                          <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_user" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">Excluir</button>
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