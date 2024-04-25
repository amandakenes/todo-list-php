<?php

include('connection.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM tarefas WHERE id = $id";

    if ($mysqli->query($sql) === TRUE) {
        echo "Tarefa excluída com sucesso!";
    } else {
        echo "Erro ao excluir tarefa: " . $mysqli->error;
    }
    $mysqli->close();
}
?>
