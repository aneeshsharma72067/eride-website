<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['admin_id'])) {
    header('location: ../admin-login.php');
    die();
}

$make = $_POST['make'];
$model = $_POST['model'];
$price = $_POST['price'];
$max_price = $_POST['max-price'];
$year = $_POST['year'];
$month = explode('-', $_POST['month'])[1];
$mileage = $_POST['mileage'];
$type = $_POST['type'];
$image_url = $_POST['image-url'];
$description = $_POST['description'];
$main_review = $_POST['main-review'];

if (trim($type) == "") {
    header('location: ../add-car-form.php?res=401');
    die();
}

$insert_query = "INSERT INTO cars(make, model, year, month, price, max_price, mileage, description, type, image_url, main_review) VALUES ('$make','$model','$year','$month','$price','$max_price','$mileage','$description','$type','$image_url','$main_review')";

$result = mysqli_query($conn, $insert_query);

if (!$result) {
    header('location: ../add-car-form.php?res=400');
    die();
}

header('location: ../admin-panel.php');
mysqli_close($conn);
