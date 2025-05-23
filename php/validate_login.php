<?php
/**
 * validate_login.php
 * Authenticates a user and starts a session.
 * Expects POST fields: userid, password
 */
session_start();
require_once __DIR__ . '/database.php';

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $logname   = trim($_POST['userid'] ?? '');
    $logpasswd = $_POST['password'] ?? '';

    // Early out if fields are missing
    if ($logname === '' || $logpasswd === '') {
        header('Location: login.html?error=missing');
        exit;
    }

    // Use a prepared statement to avoid SQL‑injection
    $stmt = mysqli_prepare($db, 'SELECT id, passwd FROM users WHERE name = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $logname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $uid, $hash);

    if (mysqli_stmt_fetch($stmt) && password_verify($logpasswd, $hash)) {
        // Success – regenerate session ID to prevent fixation
        session_regenerate_id(true);
        $_SESSION['user_id']   = $uid;
        $_SESSION['username']  = $logname;
        header('Location: tasks.php');
        exit;
    }

    // Failure
    header('Location: login.html?error=invalid');
    exit;
}

// Fall back if script hit via GET
header('Location: login.html');
exit;
?>
