<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <?php include './components/cdnlinks.php' ?>
</head>

<body class="bg-zinc-950 text-slate-200">
    <div class="w-[25%] mx-auto my-16 flex items-center justify-center flex-col">
        <h1 class="text-4xl">Admin Login</h1>
        <form action="./api/admin-login-submit.php" role="form" method="post" class="mt-10 mb-2 flex flex-col bg-gradient-to-br from-purple-900 to-blue-700 items-center justify-center gap-4 w-full py-4 rounded-xl">
            <div class="flex flex-col w-full py-2 px-10 justify-center gap-2">
                <label for="username" class="text-xl">Username</label>
                <input type="text" name="username" class="focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md " id="username">
            </div>
            <div class="flex flex-col w-full py-2 px-10 justify-center gap-2">
                <label for="password" class="text-xl ">Password</label>
                <input type="password" name="password" class="focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="password">
            </div>
            <button class="w-max py-2 px-28 rounded-lg my-5 bg-green-500 hover:bg-green-600 duration-300">Login</button>
        </form>
        <?php if (isset($_GET['res'])) {
            if ($_GET['res'] == 401) {
        ?>
                <div class="bg-red-300 text-red-600 border border-red-500 rounded-lg w-full text-lg px-5 py-2">Invalid Username or Password !!!</div>
            <?php } else { ?>
                <div class="bg-red-300 text-red-600 border border-red-500 rounded-lg w-full text-lg px-5 py-2">Something Went Wrong</div>
        <?php }
        } ?>
    </div>
</body>

</html>