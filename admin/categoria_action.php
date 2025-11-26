<?php
session_start();
require("../db/conexao.php");

if (isset($_POST['create_categoria'])){
    $nome = test_input($_POST['nome']);    
    $criado_em = date('Y-m-d');

    $query = "INSERT INTO categorias (nome, criado_em) VALUES (:nome, :criado_em)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":criado_em", $criado_em);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Categoria cadastrada com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Categoria não cadastrada!';
    }
    header('Location: categoria_list.php');
    exit;
}

if (isset($_POST['update_categoria'])){
    $id = test_input($_POST['categoria_id']);
    $nome = test_input($_POST['nome']);
   
    $query = "UPDATE categorias SET nome = :nome WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":nome", $nome);
    
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Categoria atualizada com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Categoria não atualizada!';
    }
    header('Location: categoria_list.php');
    exit;
}

if (isset($_POST['delete_categoria'])){
    $id = test_input($_POST['delete_categoria']);
    $query = "DELETE FROM categorias WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Categoria excluida com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Categoria não excluida!';
    }
    header('Location: categoria_list.php');
    exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
