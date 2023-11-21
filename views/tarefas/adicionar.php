<style>

    body {
        background-color: #1a1a1a; 
        color: white;
        font-family: Arial, sans-serif; 
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 8px;
        background-color: #2a2a2a; 
    }

    h1 {
        color: #4CAF50; 
        text-align: center;
    }


    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-size: 1.1em;
    }

    input[type="text"],
    textarea,
    select {
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #333333;
        color: white;
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border: 1px solid #4CAF50; /* Detalhe em verde claro */
    }


    input[type="submit"] {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50; /* Botão em verde claro */
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #3e8e41;
    }

</style>

<?php 
    include '../../conexao.php';
?>
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
</head>

<body>
    <div class="container">
        <h1>Adicionar Tarefa</h1>
        <form method="post" action="adicionar.php">
            <label for="titulo">Título:</label>
            <input type="text" name="nome" id="titulo"><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao"></textarea><br>

            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id">
                <option value="">Selecione uma categoria</option>
                <?php
                    $sql_categorias = 
                        "SELECT id, nome 
                            FROM categorias";
                    $result_categorias = $conexao->query($sql_categorias);

                    while ($row = $result_categorias->fetch_assoc()) {
                        $categoria_id = $row['id'];
                        $categoria_nome = $row['nome'];
                        echo "<option value='$categoria_id'>$categoria_nome</option>";
                    }
                ?>
            </select><br>

            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $categoria_id = $_POST['categoria_id'];

        $sql_tarefa = 
        "INSERT INTO 
            tarefas (nome, descricao, categoria_id) 
        VALUES 
            ('$nome', '$descricao', '$categoria_id')";
            
        if ($conexao->query($sql_tarefa) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    $conexao->close();
?>


