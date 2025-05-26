<?php
require 'conn.php';
$pdo = getPDO();

// ADD todo
function addTodo($pdo, $label) {
    $stmt = $pdo->prepare("INSERT INTO items (label, done, created_at) VALUES (?, 0, NOW())");
    $stmt->execute([$label]);
}

// UPDATE todo
function updateTodo($pdo, $id, $label, $done) {
    $stmt = $pdo->prepare("UPDATE items SET label = ?, done = ? WHERE id = ?");
    $stmt->execute([$label, $done, $id]);
}

// DELETE todo
function deleteTodo($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $label = isset($_POST['todoLabel']) ? $_POST['todoLabel'] : '';
        if (!empty($label)) {
            addTodo($pdo, $label);
        }
    } elseif ($action === 'save') {
        $id = $_POST['todo_id'];
        $label = $_POST['todoLabel'];
        $done = isset($_POST['done']) ? 1 : 0;
        updateTodo($pdo, $id, $label, $done);
    } elseif ($action === 'delete') {
        $id = $_POST['todo_id'];
        deleteTodo($pdo, $id);
    }

    header('Location: index.php');
    exit();
}