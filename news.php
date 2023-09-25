<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> News</title>
    <?php include './components/cdnlinks.php' ?>

</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>

    <div class="w-full px-44 flex flex-col gap-10 py-10">
        <h1 class="text-5xl font-bold text-slate-900 border-l-8 border-blue-500 py-3 px-5">Latest Car News</h1>
        <div class="w-full" id="news-container">
            <?php include('./components/loader.php') ?>
        </div>
    </div>
    <?php include('./components/footer.php') ?>

    <script src="./assets/js/news.js"></script>
</body>

</html>