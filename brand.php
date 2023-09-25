<?php
session_start();
if (!isset($_GET['brand'])) {
    header('location: ./new-cars.php');
    die();
}
include('./components/conn.php');
$brandName = $_GET['brand'];

$query = "SELECT  * FROM cars WHERE make = '$brandName'";

$result = mysqli_query($conn, $query);
if (!$result) {
    header('location: ./new-cars.php');
    die();
}

$query2 = "SELECT * FROM brands WHERE name = '$brandName'";

$result2 = mysqli_query($conn, $query2);
if (!$result2) {
    header('location: ./new-cars.php');
    die();
}

$brand = mysqli_fetch_assoc($result2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $brandName ?></title>
    <?php include './components/cdnlinks.php' ?>
</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>
    <div class="mx-44 my-10 flex flex-col gap-10">
        <div class="flex items-center justify-around w-full">
            <h1 class="text-8xl text-center font-bold  text-slate-700"><?php echo $brandName ?></h1>
            <img src="./assets/images/<?php echo $brandName ?>.jpg" alt="notfound" class="w-1/3 mix-blend-multiply">
        </div>
        <?php if (isset($brand['tagline'])) { ?>
            <i class="text-center text-3xl text-blue-800">‟<?php echo $brand['tagline'] ?>”</i>
        <?php } ?>
        <?php if (isset($brand['description'])) { ?>
            <p class="px-10 text-xl text-slate-600"><?php echo $brand['description'] ?></p>
        <?php } ?>
        <div class="flex flex-col gap-5 px-10">
            <h2 class="text-4xl my-5 font-bold border-l-8 border-blue-500 pl-6 py-3  text-blue-950"><?php echo $brandName ?> Cars</h2>
            <div id="car-list" class="brand-wise" data-brand="<?php echo $brandName ?>">
                <?php include('./components/loader.php') ?>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php') ?>
    <script src="./assets/js/main.js"></script>
</body>

</html>