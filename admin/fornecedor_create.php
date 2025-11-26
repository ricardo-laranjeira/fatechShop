<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatecshop - Cadastrar fornecedor</title>
  <link href="../bootstrap-5.3.8/css/bootstrap.css" rel="stylesheet">
</head>
  <body>    
      <?php include("navbar.php"); ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Adicionar fornecedor
                  <a href="fornecedor_list.php" class="btn btn-danger float-end">Voltar</a>
                </h4>
              </div>
              <div class="card-body">
                <form action="fornecedor_action.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-content" placeholder="Nome" required>
                    </div>
                    <div class="mb-3">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-content" placeholder="email@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-content" placeholder="(XX) XXXX-XXXX" required>
                    </div>
                    <div class="mb-3">
                      <input type="submit" name="create_fornecedor" class="btn btn-primary" value="Salvar">
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