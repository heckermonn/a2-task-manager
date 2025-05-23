<?php
/**
 * alter.php
 * Edits an existing task (POST only).
 */
session_start();
require_once __DIR__ . '/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id       = $_POST['editid']   ?? '';
    $name     = trim($_POST['name'] ?? '');
    $due_date = $_POST['date']     ?? '';
    $priority = $_POST['priority'] ?? '';
    $status   = $_POST['status']   ?? '';

    if (!ctype_digit($id)) {
        header('Location: tasks.php?error=badid');
        exit;
    }

    $id = (int)$id;

    $stmt = mysqli_prepare($db,
        'UPDATE tasks SET name = ?, date = ?, priority = ?, status = ? WHERE id = ?'
    );
    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $due_date, $priority, $status, $id);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die('Update failed: ' . mysqli_error($db));
    }
}

header('Location: tasks.php');
exit;
?>
