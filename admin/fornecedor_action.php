<?php
session_start();
require("../db/conexao.php");

if (isset($_POST['create_fornecedor'])){
    $nome = test_input($_POST['nome']);
    $email = test_input($_POST['email']);
    $telefone = test_input($_POST['telefone']);
    $criado_em = date('Y-m-d');

    $query = "INSERT INTO fornecedores (nome, email, telefone, criado_em) VALUES (:nome, :email, :telefone, :criado_em)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
    $stmt->bindParam(":criado_em", $criado_em);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Fornecedor cadastrado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Fornecedor não cadastrado!';
    }
    header('Location: fornecedor_list.php');
    exit;
}

if (isset($_POST['update_fornecedor'])){
    $id = test_input($_POST['fornecedor_id']);
    $nome = test_input($_POST['nome']);
    $email = test_input($_POST['email']);
    $telefone = test_input($_POST['telefone']);
    
    $query = "UPDATE fornecedores SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":telefone", $telefone);
    
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Fornecedor atualizado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Fornecedor não atualizado!';
    }
    header('Location: fornecedor_list.php');
    exit;
}

if (isset($_POST['delete_fornecedor'])){
    $id = test_input($_POST['delete_fornecedor']);
    $query = "DELETE FROM fornecedores WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Fornecedor excluido com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Fornecedor não excluido!';
    }
    header('Location: fornecedor_list.php');
    exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
