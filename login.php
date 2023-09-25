<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('location: ./');
    die();
}

if (isset($_SESSION['login_refresh'])) {
    unset($_SESSION['login_refresh']);
    header('location: ./login.php');
    die();
}

if (isset($_GET['res'])) {
    $_SESSION['login_refresh'] = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include './components/cdnlinks.php' ?>

</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>
    <div class="w-full flex flex-col items-center justify-center">
        <div class="signup-container flex w-3/5 my-6 border-2 border-blue-500 rounded-xl">
            <div class="flex-1 flex flex-col gap-3 px-10 py-5">
                <h1 class="text-3xl text-slate-700 px-1 border-b-2 border-b-blue-600 w-max py-3">Login</h1>
                <form action="./api/user-login-submit.php" method="post" class="flex flex-col gap-3">
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="email">Email</label>
                        <input type="email" name="email" id="email" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                    </div>
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="password">Password</label>
                        <input type="password" name="password" id="password" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                    </div>

                    <button type="submit" class="bg-blue-500 px-7 py-2 rounded-full text-lg my-3 text-white w-max">Login</button>
                </form>
            </div>
            <div class="flex-1 gap-4 px-10 text-center bg-gradient-to-br flex flex-col items-center py-24 text-lg from-blue-500 to-blue-300 text-white">
                <h2 class="text-4xl font-bold">First Time Here ? </h2>
                <p class="text-xl">Click here to get started</p>
                <a href="./signup.php" class="bg-slate-800 text-white px-6 py-2 duration-200 hover:bg-slate-950 rounded-full">Signup</a>
            </div>
        </div>
        <?php if (isset($_GET['res'])) {
            if ($_GET['res'] == 401) {
        ?>
                <div class=" bg-red-300 text-red-600 border border-red-500 rounded-lg w-3/5 mb-10 mx-10 text-lg px-5 py-2">Invalid Credentials !!</div>
            <?php } else { ?>
                <div class=" bg-red-300 text-red-600 border border-red-500 rounded-lg w-3/5 mb-10 mx-10 text-lg px-5 py-2">Something Went Wrong !!</div>
        <?php }
        } ?>
    </div>
    <?php include('./components/footer.php') ?>
</body>

</html>