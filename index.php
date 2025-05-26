<?php
require 'conn.php';
$pdo = getPDO();

$stmt = $pdo->query("SELECT * FROM items ORDER BY created_at DESC");
$todos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Project</title>
    <?php include('header.php'); ?>
</head>
<body>
    <nav>
        <h1>"Per çdo minute duke organizuar, fitohet nje ore." - Benjamin Franklin</h1>
    </nav>
    <main>
        <div class="main-content">
            <h2>TODO's</h2>
            <div class="buttons">
                <button id="add" onclick="add()">Add</button>
            </div>
            <?php foreach ($todos as $todo): ?>
                <form method="post" action="handle_todo.php" class="todo-form">
                    <input type="hidden" name="todo_id" value="<?= $todo['id'] ?>">
                    <input type="checkbox" name="done" <?= $todo['done'] ? 'checked' : '' ?>>
                    <input id="todoLabel" type="text" name="todoLabel" value="<?= htmlspecialchars($todo['label']) ?>">

                    <button type="submit" class="save-btn" name="action" value="save">Save</button>
                    <button type="submit" class="delete-btn" name="action" value="delete">Delete</button>
                </form>
            <?php endforeach; ?>

            <div class="addNewTodo">
                <h2>Add New Todo</h2>
                <form method="post" action="handle_todo.php">
                    <input type="text" name="todoLabel" placeholder="Shto nje task te ri">
                    <button type="submit" class="save-btn" name="action" value="add">Shto</button>
                </form>
            </div>

        </div>
    </main>
</body>
</html>

<script>
    function add() {
        const addNew = document.querySelector(".addNewTodo");
        addNew.classList.toggle("show");
    }
</script>

