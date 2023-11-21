<!DOCTYPE html>
<html lang="en">
<?php
    include '../../base/header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categorias</title>
    <link rel="stylesheet" href="../../css/categorias.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>

<body>
    <main>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="observacao">Observação:</label>
            <textarea id="observacao" name="observacao"></textarea>
            <button type="submit">Enviar</button>
        </form>
    </main>
</body>

<?php 
    include '../../conexao.php';
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $observacao = $_POST['observacao'];

        $sql_categorias = 
        "INSERT INTO 
            categorias (nome, observacao) 
        VALUES 
            ('$nome', '$observacao')";
            
        if ($conexao->query($sql_categorias) === TRUE) {
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    $conexao->close();
?>

</html>

<?php
    include '../../base/footer.php';
?>