<?php
session_start();
require("../db/conexao.php");
$query = $pdo->prepare("SELECT id, nome, criado_em FROM categorias;");
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
      <div class="container">
        <?php include("mensagem.php"); ?>
        <form class="form d-flex gap-3 mt-3" action="categoria_action.php" method="post">
            <input autocomplete="off" placeholder="Nova Categoria" class="form-control" type="text" name="nome">           
            <input type="submit" name="create_categoria" value="Cadastrar" class="btn btn-sm btn-primary">
        </form>
        <hr>
        <div class="card-body">
        <table class="table table-borded table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($categoria = $query->fetch()){
                ?>
                    <tr>
                        <td><?= $categoria['id'] ?></td>
                        <td><?= $categoria['nome'] ?></td>
                        <td><?= $categoria['criado_em'] ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="categoria_edit.php?id=<?= $categoria['id'] ?>">Editar</a>
                            <form action="categoria_action.php" method="POST" class="d-inline">
                                <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_categoria" value="<?= $categoria['id'] ?>" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <script src="../bootstrap-5.3.8/js/bootstrap.js"></script>
  </body>
</html>