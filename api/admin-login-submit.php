<?php
session_start();
include('../components/conn.php');
$username = $_POST['username'];
$password = $_POST['password'];

$get_admin_query = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
$admin_result = mysqli_query($conn, $get_admin_query);

if (!$admin_result) {
    header('location: ../admin-login.php?res=400');
    die();
}

$row_count = mysqli_num_rows($admin_result);
if ($row_count == 0) {
    header('location: ../admin-login.php?res=401');
    die();
}

$admin = mysqli_fetch_assoc($admin_result);
$_SESSION['admin_id'] = $admin['admin_id'];
$_SESSION['Username'] = $admin['Username'];
$_SESSION['Password'] = $admin['Password'];

header('location: ../admin-panel.php');
mysqli_close($conn);
