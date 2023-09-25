<?php
$cur = substr($_SERVER['REQUEST_URI'], 28);
$afterClass = "after:content-[''] after:w-full after:h-1 after:rounded-full after:bg-blue-500 after:block active-link";
?>
<div class="fadeIn w-full flex justify-around items-center h-[10vh] sticky top-0 backdrop-filter backdrop-blur-lg bg-opacity-70 bg-slate-300 z-30 shadow-[0_0_10px_#303030c5]">
    <div class="logo w-1/5">
        <a href="./">
            <img src="./assets/images/logo.png" alt="Not Found" class="w-1/2">

        </a>
    </div>
    <ul class="flex gap-20 text-lg h-full items-center">
        <li><a href="./" class="<?php if ($cur == '') echo $afterClass ?>">Home</a></li>
        <li class=" cursor-pointer relative group h-full flex items-center justify-center">
            <a href="./new-cars.php" class="<?php if ($cur == 'new-cars.php') echo $afterClass ?>">Cars</a>
        </li>
        <li class="h-full flex items-center justify-center"><a href="./news.php" class="<?php if ($cur == 'news.php') echo $afterClass ?>">News</a></li>
        <li class="h-full flex items-center justify-center"><a href="./contact.php" class="<?php if ($cur == 'contact.php') echo $afterClass ?>">Contact</a></li>
    </ul>
    <?php if (!isset($_SESSION['user_id'])) { ?>
        <div class="auth-links flex gap-4">
            <a href="./login.php" class="bg-blue-500 py-2 px-6 rounded-lg text-slate-200 text-base">Login</a>
            <a href="./signup.php" class="bg-blue-500 py-2 px-6 rounded-lg text-slate-200 text-base">Signup</a>
        </div>
    <?php } else { ?>
        <div class="auth-links flex gap-4 items-center">
            <a href="./dashboard.php" class="bg-gradient-to-br from-red-500 to-red-300 rounded-lg px-3 py-2"><?php echo $_SESSION['username'] ?></a>
            <a href="./api/user-logout.php" class="bg-blue-500 duration-200 hover:bg-blue-700 py-2 px-6 rounded-lg text-slate-200 text-base">Logout</a>
        </div>
    <?php } ?>
</div>