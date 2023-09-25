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
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $first_name = validate($_POST['firstName']);
    $last_name = validate($_POST['lastName']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);
    $password = validate($_POST['password']);
    $gender = validate($_POST['gender']);
    $full_name = $first_name . ' ' . $last_name;
}

if ($username == '' || $password == '') {
    header('location: ../signup.php?&res=401');
    die();
}

$password = sha1($password);



try {
    $query = "INSERT INTO users(first_name, last_name, username, password, gender, email, full_name, phone_number, address) VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "sssssssss", $first_name, $last_name, $username, $password, $gender, $email, $full_name, $phone, $address);

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        header('location: ../signup.php?&res=401');
    }

    // log the user in
    $get_user_id = "SELECT user_id FROM users WHERE username = '$username' AND password = '$password'";
    $user_id_result = mysqli_query($conn, $get_user_id);
    $user_id = mysqli_fetch_assoc($user_id_result);
    $_SESSION['user_id'] = $user_id['user_id'];
    $_SESSION['username'] = $username;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;
    $_SESSION['gender'] = $gender;

    header('location: ../');
} catch (mysqli_sql_exception $e) {
    echo $e;
    exit;
} finally {
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
