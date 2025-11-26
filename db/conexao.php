<?php

try {
    $pdo = new PDO("sqlite:". __DIR__ ."/fatecshop.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Erro: ".$e->getMessage();
    exit;
}

$query = "CREATE TABLE IF NOT EXISTS usuarios (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome TEXT, email TEXT, senha TEXT, criado_em DATE);";
$pdo->exec($query);

$query = "CREATE TABLE IF NOT EXISTS fornecedores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome TEXT, email TEXT, telefone TEXT, criado_em DATE);";
$pdo->exec($query);

$query = "CREATE TABLE IF NOT EXISTS categorias (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome TEXT, criado_em DATE);";
$pdo->exec($query);

$query = "CREATE TABLE IF NOT EXISTS produtos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fornecedor_id INTEGER, categoria_id INTEGER, nome TEXT, preco REAL, quantidade INTEGER, criado_em DATE, FOREIGN KEY(fornecedor_id) REFERENCES fornecedores(id) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON UPDATE CASCADE ON DELETE CASCADE);";
$pdo->exec($query);

$stmt = $pdo->prepare("SELECT count(id) FROM usuarios;");
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count < 1) {
    $senha = password_hash("admin", PASSWORD_DEFAULT);
    $criado_em = date('Y-m-d');
    $query = "INSERT INTO usuarios (nome, email, senha, criado_em) VALUES ('Ricardo', 'ricardo@admin.com', :senha, :criado_em)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->bindParam(":criado_em", $criado_em);
    $stmt->execute();
}