<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location: ./');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <?php include './components/cdnlinks.php' ?>

</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>
    <div class="w-full flex items-center justify-center">
        <div class="signup-container flex w-[70%] my-10 border-2 border-blue-500 rounded-xl">
            <div class="flex-1 flex flex-col gap-3 px-10 py-5">
                <h1 class="text-3xl text-slate-700 px-1 border-b-2 border-b-blue-600 w-max py-3">Sign Up</h1>
                <form action="./api/user-signup-submit.php" method="post" class="flex flex-col gap-3">
                    <div class="flex justify-between gap-3">
                        <div class="flex flex-col justify-center gap-3">
                            <label class="text-lg px-2" for="firstName">First Name</label>
                            <input required type="text" name="firstName" id="firstName" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                        </div>
                        <div class="flex flex-col justify-center gap-3">
                            <label class="text-lg px-2" for="lastName">Last Name</label>
                            <input required type="text" name="lastName" id="lastName" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                        </div>
                    </div>
                    <div class="flex justify-between gap-3">
                        <div class="flex flex-col justify-center gap-3">
                            <label class="text-lg px-2" for="username">Username</label>
                            <input required type="text" name="username" id="username" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                        </div>
                        <div class="flex flex-col justify-center gap-3">
                            <label class="text-lg px-2" for="gender">Gender</label>
                            <select name="gender" id="gender" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]" aria-placeholder="gender">
                                <option value="">Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="email">Email</label>
                        <input required type="email" name="email" id="email" class="duration-300 focus:shadow-[0_0_10px_#1d4ed8] outline-none text-lg px-4 py-2 rounded-full">
                    </div>
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="phone">Phone Number</label>
                        <input required type="number" name="phone" id="phone" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                    </div>
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="address">Address</label>
                        <input required type="text" name="address" id="address" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                    </div>
                    <div class="flex flex-col justify-center gap-3">
                        <label class="text-lg px-2" for="password">Password</label>
                        <input required type="password" name="password" id="password" class="outline-none text-lg px-4 py-2 rounded-full duration-300 focus:shadow-[0_0_10px_#1d4ed8]">
                    </div>

                    <button type="submit" class="bg-blue-500 px-7 py-2 rounded-full text-lg my-3 text-white w-max">Sign Up</button>
                </form>
            </div>
            <div class="flex-1 gap-4 px-10 text-center bg-gradient-to-br flex flex-col items-center py-40 text-lg from-blue-500 to-blue-300 text-white">
                <h2 class="text-4xl font-bold">Already Registered ? </h2>
                <p class="text-xl">Click here to continue your journey</p>
                <a href="./login.php" class="bg-slate-800 text-white px-6 py-2 duration-200 hover:bg-slate-950 rounded-full">Login</a>
            </div>
        </div>
        <?php if (isset($_GET['res'])) {
            if ($_GET['res'] == 401) {
        ?>
                <div class=" bg-red-300 text-red-600 border border-red-500 rounded-lg w-[90%] mx-10 text-lg px-5 py-2">Please fill all the details !!</div>
            <?php } else { ?>
                <div class=" bg-red-300 text-red-600 border border-red-500 rounded-lg w-[90%] mx-10 text-lg px-5 py-2">Something Went Wrong !!</div>
        <?php }
        } ?>
    </div>
    <?php include('./components/footer.php') ?>
</body>

</html>