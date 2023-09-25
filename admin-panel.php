<?php
session_start();
include('./components/conn.php');
if (!isset($_SESSION['admin_id'])) {
    header('location: admin-login.php');
    die();
}

$admin_id = $_SESSION['admin_id'];
$get_admin_query = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
$admin_query_result = mysqli_query($conn, $get_admin_query);
if (!$admin_query_result) {
    echo "Something Went Wrong";
    return;
}

$admin = mysqli_fetch_assoc($admin_query_result);
if (!$admin) {
    echo "Something Went Wrong";
}


// $admin_id = $_SESSION['user_id']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php include('./components/cdnlinks.php') ?>
</head>

<body class="bg-zinc-900">
    <div class="w-full px-32 py-4 flex flex-col">
        <div class="flex justify-between items-center my-10">
            <h1 class="text-5xl font-bold text-purple-700 border-4 border-blue-700 border-t-0 border-l-0 w-max py-3 px-6">Admin Panel</h1>
            <div class="flex gap-5">
                <a href="./" class="bg-blue-500 px-5 py-3 rounded-lg text-lg text-white hover:bg-blue-700 duration-300">Home</a>
                <a href="./api/admin-logout.php" class="bg-blue-500 hover:bg-blue-700 duration-300 px-5 py-3 rounded-lg text-lg text-white">Logout</a>
            </div>
        </div>
        <div class="admin-detais px-14 py-10 my-10 shadow-[0_0_20px_#1d4ed8] w-max rounded-xl text-white flex flex-col gap-4">
            <h2 class="text-3xl ">Admin Details</h2>
            <div class="flex gap-6 text-2xl ">
                <span class="text-orange-600">Name</span>
                <span><?php echo $admin['FirstName'] . ' ' . $admin['LastName'] ?></span>
            </div>
            <div class="flex gap-6 text-2xl ">
                <span class="text-orange-600">Email</span>
                <span><?php echo $admin['Email'] ?></span>
            </div>
        </div>
        <?php
        include('./components/conn.php');
        $query = 'SELECT * FROM cars';
        $result = mysqli_query($conn, $query) or die('Query Unsuccessfull');
        ?>
        <div class="flex justify-between items-center my-10">
            <h2 class="text-white text-5xl font-bold ">Car Data</h2>
            <a href="./add-car-form.php" class="flex gap-3 items-center justify-center duration-300 hover:bg-blue-700 bg-blue-500 px-5 py-3 rounded-xl">
                <span class="text-2xl text-white">Add</span>
                <svg width="35" height="35" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5.25v13.5"></path>
                    <path d="M18.75 12H5.25"></path>
                </svg>
            </a>
        </div>
        <div class="cars-data grid grid-cols-3 gap-5">
            <?php
            while ($car = mysqli_fetch_assoc($result)) {
            ?>
                <div class="flex flex-col justify-around gap-3 text-slate-300 shadow-[0_0_20px_#000] py-3 rounded-xl px-4 hover:shadow-[0_0_20px_#1d4ed8] duration-300">
                    <img src="<?php echo $car['image_url'] ?>" alt="" class="rounded-xl">
                    <div class="flex justify-between text-xl">
                        <span><?php echo $car['make'] . ' ' . $car['model'] ?></span>
                        <span><?php echo DateTime::createFromFormat('!m', $car['month'])->format('F') . ' ' . $car['year'] ?></span>
                    </div>
                    <p class="text-3xl font-mono text-yellow-500">Rs <?php if ($car['price'] < 10000000) {
                                                                            echo $car['price'] / 100000, ' Lakh';
                                                                        } else {
                                                                            echo $car['price'] / 10000000, ' Cr';
                                                                        } ?></p>
                    <div class="flex justify-between py-5">
                        <a href="./edit-car-form.php?car_id=<?php echo $car['car_id'] ?>" class="bg-green-500 px-8 hover:bg-green-800 py-3 duration-200 rounded-lg">Edit</a>
                        <a href="./api/delete-car.php?car_id=<?php echo $car['car_id'] ?>" class="duration-200 bg-red-500 px-6 py-3 rounded-lg hover:bg-red-800">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>