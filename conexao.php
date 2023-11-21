<?php
    $host = 'localhost';
    $user = 'root';
    $pass = 'root'; // Vazio
    $db   = 'gerenciador_tarefas'; // Nome do teu banco

    $conexao = new mysqli($host, $user, $pass, $db);

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    } 
?>