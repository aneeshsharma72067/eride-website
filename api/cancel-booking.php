<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
    die();
}
if (!isset($_GET['id'])) {
    header('location :' . $_SERVER['HTTP_REFERER']);
    die();
}

$id = $_GET['id'];
try {
    $query = "DELETE FROM transactions WHERE transaction_id = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        header('location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    header('location: ' . $_SERVER['HTTP_REFERER']);
} catch (mysqli_sql_exception $e) {
    echo $e;
} finally {
    mysqli_close($conn);
}
