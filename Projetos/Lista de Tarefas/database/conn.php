<?php

$hostname = 'localhost';
$database = 'to_do_list';
$username = 'postgres';
$password = '<sua_senha>'; // Substitua pela sua senha do PostgreSQL

try {
    $pdo = new PDO("pgsql:host=$hostname;dbname=$database", $username, $password);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}