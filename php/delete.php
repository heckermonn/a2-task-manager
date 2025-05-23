<?php
/**
 * delete.php
 * Deletes a task via ?deleteid=ID or POST.
 */
session_start();
require_once __DIR__ . '/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$db = db_connect();

$id = null;

if (isset($_POST['deleteid'])) {
    $id = $_POST['deleteid'];
} elseif (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
}

if ($id !== null && ctype_digit((string)$id)) {
    $id = (int)$id;
    $stmt = mysqli_prepare($db, 'DELETE FROM tasks WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

header('Location: tasks.php');
exit;
?>
