<?php
/**
 * insert.php
 * Inserts a new task. Expects POST: name, date, priority, status
 */
session_start();
require_once __DIR__ . '/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name'] ?? '');
    $due_date = $_POST['date'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $status   = $_POST['status'] ?? '';

    // Basic input validation (expand as needed)
    if ($name === '' || $due_date === '' || $priority === '' || $status === '') {
        header('Location: tasks.php?error=missing');
        exit;
    }

    $stmt = mysqli_prepare($db,
        'INSERT INTO tasks (name, date, priority, status) VALUES (?, ?, ?, ?)'
    );
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $due_date, $priority, $status);

    mysqli_stmt_execute($stmt);
}

header('Location: tasks.php');
exit;
?>
