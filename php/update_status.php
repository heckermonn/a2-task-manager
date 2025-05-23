<?php
/**
 * update_status.php
 * Marks a task as completed via GET ?updateid=ID or POST.
 */
session_start();
require_once __DIR__ . '/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$db = db_connect();

$id = null;

// Accept either GET or POST for backward compatibility
if (isset($_POST['updateid'])) {
    $id = $_POST['updateid'];
} elseif (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];
}

if ($id !== null && ctype_digit((string)$id)) {
    $id = (int)$id;
    $status = 'Completed';

    $stmt = mysqli_prepare($db, 'UPDATE tasks SET status = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
}

header('Location: tasks.php');
exit;
?>
