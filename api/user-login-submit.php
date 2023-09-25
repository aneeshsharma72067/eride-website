<?php
session_start();
include('../components/conn.php');
if (isset($_SESSION['user_id'])) {
    header('location: ../');
}
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
}

if ($email == '' || $password == '') {
    header('location: ./login.php?res=401');
}

$password = sha1($password);

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (!$result) {
    header('location: ../login.php?res=400');
    die();
}
$row_count = mysqli_num_rows($result);
if ($row_count == 0) {
    header('location: ../login.php?res=401');
    die();
}

$user = mysqli_fetch_assoc($result);

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
$_SESSION['first_name'] = $user['first_name'];
$_SESSION['last_name'] = $user['last_name'];
$_SESSION['email'] = $user['email'];
$_SESSION['phone'] = $user['phone_number'];
$_SESSION['address'] = $user['address'];
$_SESSION['gender'] = $user['gender'];

header('location: ../');
die();
