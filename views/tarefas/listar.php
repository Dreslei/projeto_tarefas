<?php

include '../../conexao.php';
    $limite = 10;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $limite;
    
    $sql = "SELECT 
                t.id, 
                t.nome AS titulo, 
                t.descricao, 
                t.criado_em, 
                c.nome AS categoria
            FROM tarefas as t
            LEFT JOIN categorias as c ON t.categoria_id = c.id
            LIMIT $inicio, $limite
            ";


    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php
    include '../../base/header.php';
?>
<head>
    <link rel="stylesheet" href="../../css/tarefas.css">
    <link rel="stylesheet" href="../../css/header.css">
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Tarefas</h1>
    <a href="adicionar.php">Adicionar Nova Tarefa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . htmlspecialchars_decode($row["titulo"]) . "</td>";
                    echo "<td>" . $row["descricao"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td>" . date('d-m-Y H:i:s', strtotime($row["criado_em"])) . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | 
                    <a class='deletar' href='deletar.php?id=" . $row["id"] . "'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Sem tarefas</td></tr>";
            }
            ?>
        </tbody>
        <div class="pagination">
            <?php  
                $total = "SELECT COUNT(id) AS total FROM tarefas";
                $result = $conexao->query($total);
                $row = $result->fetch_assoc();
                $paginas = ceil($row['total'] / $limite);

                for($i = 1; $i <= $paginas; $i++) {
                    if ($i == $pagina) {
                        echo "<strong>$i</strong> ";
                    } else {
                        echo "<a href='listar.php?pagina=$i'>$i</a> ";
                    }
                }
            ?>
        <div>
    </table>
</body>
</html>

<?php $conexao->close(); ?>
