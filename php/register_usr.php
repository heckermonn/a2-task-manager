<?php
/**
 * register_usr.php
 * Registers a new user.
 * Expects POST fields: userid, password, confirm_password
 */
session_start();
require_once __DIR__ . '/database.php';

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $regname  = trim($_POST['userid'] ?? '');
    $passwd   = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // Validate input
    if ($regname === '' || $passwd === '') {
        header('Location: registration.php?error=missing');
        exit;
    }
    if ($passwd !== $confirm) {
        header('Location: registration.php?error=mismatch');
        exit;
    }

    // Check if user already exists
    $stmt = mysqli_prepare($db, 'SELECT 1 FROM users WHERE name = ?');
    mysqli_stmt_bind_param($stmt, 's', $regname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header('Location: registration.php?error=exists');
        exit;
    }

    // Insert
    $hash = password_hash($passwd, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($db, 'INSERT INTO users (name, passwd) VALUES (?, ?)');
    mysqli_stmt_bind_param($stmt, 'ss', $regname, $hash);
    if (!mysqli_stmt_execute($stmt)) {
        error_log('Registration insert failed: ' . mysqli_error($db));
        header('Location: registration.php?error=db');
        exit;
    }

    header('Location: login.html?registered=1');
    exit;
}

// Default – bounce back
header('Location: registration.php');
exit;
?>
