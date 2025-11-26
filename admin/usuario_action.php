<?php
session_start();
require("../db/conexao.php");

if (isset($_POST['create_user'])){
    $nome = test_input($_POST['nome']);
    $email = test_input($_POST['email']);
    $senha = password_hash(test_input($_POST['senha']),PASSWORD_DEFAULT);
    $criado_em = date('Y-m-d');

    $query = "INSERT INTO usuarios(nome, email, senha, criado_em) VALUES (:nome, :email, :senha, :criado_em)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->bindParam(":criado_em", $criado_em);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Usuário cadastrado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Usuário não cadastrado!';
    }
    header('Location: usuario_list.php');
    exit;
}

if (isset($_POST['update_user'])){
    $id = test_input($_POST['usuario_id']);
    $nome = test_input($_POST['nome']);
    $email = test_input($_POST['email']);
    $senha = test_input($_POST['senha']);

    if (!empty($senha)){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
    } else {
        $query = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
    }    
    
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Usuário não atualizado!';
    }
    header('Location: usuario_list.php');
    exit;
}

if (isset($_POST['delete_user'])){
    $id = test_input($_POST['delete_user']);
    $query = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'Usuário excluido com sucesso!';        
    } else {
        $_SESSION['mensagem'] = 'Usuário não excluido!';
    }
    header('Location: usuario_list.php');
    exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
