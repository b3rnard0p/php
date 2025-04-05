<?php
require_once('database/conn.php');

$tasks = [];

$sql = $pdo->query("SELECT * FROM task ORDER BY id ASC");

if ($sql->rowCount() > 0) {
    $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400&display=swap" rel="stylesheet">
    <title>To-do list</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#10101d',
                        secondary: '#191933',
                        accent: '#ee9ca7',
                        text: '#e5f9ff',
                        edit: '#6c9bbc',
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .task-checkbox:checked + .task-description {
                @apply line-through text-text/60;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-[url('src/images/OnePiece.jpg')] bg-cover bg-no-repeat">
    <div id="to_do" class="flex flex-col gap-6 bg-primary p-4 rounded-lg w-[430px]">
        <h1 class="text-text text-2xl uppercase">Lista de Tarefas</h1>

        <form action="actions/create.php" method="POST" class="to-do-form flex w-full">
            <input 
                type="text" 
                name="description" 
                placeholder="Escreva sua tarefa aqui" 
                required
                class="bg-transparent border-none text-text text-base w-full px-1 border-b-2 border-accent focus:outline-none"
            >
            <button type="submit" class="form-button border-none min-w-10 min-h-10 bg-accent rounded-full text-xl hover:scale-105 transition-transform">
                <i class="fa-solid fa-plus"></i>
            </button>
        </form>

        <div id="tasks" class="flex flex-col gap-3 max-h-[400px] overflow-auto">
            <?php foreach($tasks as $task): ?>
                <div class="task flex items-center justify-between bg-secondary text-gray-800 p-2 rounded">
                    <div class="flex items-center w-full">
                        <input 
                            type="checkbox" 
                            name="progress" 
                            class="task-checkbox mr-2 <?= $task['completed'] ? 'done' : '' ?>"
                            data-task-id="<?= $task['id']?>"
                            <?= $task['completed'] ? 'checked' : '' ?>
                        >

                        <p class="task-description text-text text-base px-1 py-1 w-full">
                            <?= $task['description'] ?>
                        </p>
                    </div>

                    <div class="task-actions flex gap-2">
                        <a class="action-button edit-button text-edit text-base">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                        <a href="actions/delete.php?id=<?= $task['id']?>" class="action-button delete-button text-accent text-base">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </div>

                    <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden absolute">
                        <input type="text" class="hidden" name="id" value="<?= $task['id']?>">
                        <input 
                            type="text"
                            name="description" 
                            placeholder="Edit your task here" 
                            value="<?= $task['description']?>"
                            class="bg-transparent border-none text-text text-base w-full px-1 border-b-2 border-accent focus:outline-none"
                        >
                        <button type="submit" class="form-button border-none min-w-10 min-h-10 bg-accent rounded-full text-xl hover:scale-105 transition-transform">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="src/javascript/script.js"></script>
</body>
</html>