<?php
/******************************************************************
 * database.php
 * Single place to open & close a MySQL connection using mysqli.
 * Reads credentials from environment variables if they exist,
 * else falls back to values defined in credentials.php.
 ******************************************************************/
require_once __DIR__ . '/credentials.php';

function db_connect() {
    // Allow overriding via environment variables for production.
    $server = getenv('DB_SERVER') ?: DB_SERVER;
    $user   = getenv('DB_USER')   ?: DB_USER;
    $pass   = getenv('DB_PASS')   ?: DB_PASS;
    $name   = getenv('DB_NAME')   ?: DB_NAME;

    $connection = mysqli_connect($server, $user, $pass, $name);
    confirm_db_connect($connection);

    return $connection;
}

function db_disconnect($connection) {
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

function confirm_db_connect($connection) {
    if (mysqli_connect_errno()) {
        $msg  = 'Database connection failed: ';
        $msg .= mysqli_connect_error();
        $msg .= ' (' . mysqli_connect_errno() . ')';
        error_log($msg);
        exit($msg);
    }
}

function confirm_result_set($result_set) {
    if (!$result_set) {
        exit('Database query failed.');
    }
}
?>
