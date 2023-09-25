<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: ./login.php');
    die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include './components/cdnlinks.php' ?>

</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>
    <div class="flex flex-col gap-5 w-3/5 mx-auto my-10">
        <h1 class="text-5xl text-slate-700">Hello, <?php echo $_SESSION['first_name'] ?></h1>
        <div class="flex flex-col gap-4">
            <h2 class="text-3xl my-4 font-bold text-blue-950">User Details</h2>
            <div class="grid grid-cols-2 gap-4 neuromorphism-color rounded-xl px-10 py-5">
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">First Name </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['first_name'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Last Name </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['last_name'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Email </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['email'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Username </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['username'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Gender </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['gender'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Phone Number </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['phone'] ?></span>
                </div>
                <div class="flex gap-4 items-center text-lg flex-nowrap px-4 py-2">
                    <span class="font-bold text-slate-600">Address </span>
                    <span class="bg-blue-500 rounded-md text-white py-1 px-3"><?php echo $_SESSION['address'] ?></span>
                </div>

            </div>
        </div>

        <div class="flex flex-col gap-4">
            <h2 class="text-3xl my-4 font-bold text-blue-950">Favorites</h2>
            <div id="car-list" class="w-full favorites">
            </div>
        </div>
    </div>
    <?php include('./components/footer.php') ?>
    <script src="./assets/js/main.js"></script>
</body>

</html>