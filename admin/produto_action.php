<?php
session_start();
require("../db/conexao.php");

if (isset($_POST['create_produto'])){
    $fornecedor = test_input($_POST['fornecedor_id']);
    $categoria = test_input($_POST['categoria_id']);
    $nome = test_input($_POST['nome']);
    $preco = test_input($_POST['preco']);
    $quantidade = test_input($_POST['quantidade']);    
    $criado_em = date('Y-m-d');

    $query = "INSERT INTO produtos (fornecedor_id, categoria_id, nome, preco, quantidade, criado_em) VALUES (:fornecedor_id, :categoria_id, :nome, :preco, :quantidade, :criado_em)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":fornecedor_id", $fornecedor, PDO::PARAM_INT);
    $stmt->bindParam(":categoria_id", $categoria, PDO::PARAM_INT);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(":criado_em", $criado_em);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Produto cadastrado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Produto não cadastrado!';
    }
    header('Location: produto_list.php');
    exit;
}

if (isset($_POST['update_produto'])){
    $id = test_input($_POST['produto_id']);
    $fornecedor = test_input($_POST['fornecedor_id']);
    $categoria = test_input($_POST['categoria_id']);
    $nome = test_input($_POST['nome']);
    $preco = test_input($_POST['preco']);
    $quantidade = test_input($_POST['quantidade']);

    $query = "UPDATE produtos SET fornecedor_id = :fornecedor_id, categoria_id = :categoria_id, nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":fornecedor_id", $fornecedor);
    $stmt->bindValue(":categoria_id", $categoria);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":preco", $preco);
    $stmt->bindValue(":quantidade", $quantidade);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Produto atualizado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Produto não atualizado!';
    }
    header('Location: produto_list.php');
    exit;
}

if (isset($_POST['delete_produto'])){
    $id = test_input($_POST['delete_produto']);
    $query = "DELETE FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Produto excluido com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Produto não excluido!';
    }
    header('Location: produto_list.php');
    exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
