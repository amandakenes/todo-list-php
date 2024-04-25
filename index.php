<?php
include('connection.php');

if (isset($_POST['tarefa'])) {
    if (!empty($_POST['tarefa'])) {
        $nova_tarefa = $_POST['tarefa'];

        $stmt = $mysqli->prepare("INSERT INTO tarefas (tarefa) VALUES (?)");
        $stmt->bind_param("s", $nova_tarefa);
        $stmt->execute();
        $stmt->close();

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    };
};

$sql = "SELECT id, tarefa FROM tarefas";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Simple To-Do List</title>
</head>

<body class="w-9/12 bg-blue-300 min-h-screen mx-auto mt-20 h-screen">
    <div class="mx-auto p-6 bg-white rounded-md shadow-md">
        <h1 class="text-4xl font-bold mb-4 text-yellow-300 text-center ">Lista de Tarefas</h1>

        <form action="" method="post" class="mb-4">
            <input type="text" name="tarefa" id="newTask" placeholder="Digite uma nova tarefa" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit" class="w-full mt-2 px-4 py-2 bg-yellow-300 bg-opacity-75 text-white rounded-md hover:bg-opacity-95 transition duration-100">Adicionar</button>
        </form>

        <ul class="space-y-2">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='border border-gray-300 p-2 rounded-md flex justify-between'>";
                    echo "<span>" . $row["tarefa"] . "</span>";
                    echo "<button class='bg-gray-800 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-100' onclick='deleteTask(" . $row["id"] . ")'>Excluir</button>";
                    echo "</li>";
                }
            } else {
                echo "<li class='text-gray-500'>Nenhuma tarefa encontrada</li>";
            }
            ?>
        </ul>
    </div>

    <script src="/js/script.js"></script>
</body>
</html>