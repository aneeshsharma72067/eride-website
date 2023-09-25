<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carde</title>
    <?php include './components/cdnlinks.php' ?>
</head>

<body class="bg-slate-200">
    <?php include('./components/conn.php') ?>
    <div class="flex flex-col gap-0">
        <?php include('./components/navbar.php') ?>
        <div class="hero ">
            <div class="slideIn banner-text px-10 pl-32 py-28 text-white flex gap-5 flex-col">
                <h1 class="text-6xl font-bold w-[70%] ">Uncover Your Dream Car, Where Style Meets Performance</h1>
                <p class="text-xl w-2/5">Explore a Vast Collection of New and Used Vehicles, Expert Reviews, and Car Buying Guides</p>
                <a href="./new-cars.php" class="text-xl bg-blue-500 w-max py-3 px-5 border-2 border-white hover:bg-white hover:text-blue-500 rounded-lg duration-300">Start Your Journey</a>
            </div>
        </div>

        <div class="featured px-32 py-10 flex flex-col gap-10">
            <h2 class="text-4xl font-bold text-slate-800 mx-16 border-l-[6px] px-4 py-3 border-l-blue-500">Featured Cars</h2>
            <div class="featured-cars-container">
                <?php
                $query = 'SELECT * FROM cars LIMIT 3';
                $result = mysqli_query($conn, $query) or die('Query Unsuccessfull');
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <div class="featured-cars-list gap-4 flex mx-auto items-center justify-center">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="relative featured-card-1 duration-300 hover:scale-105 cursor-pointer flex flex-col text-slate-800 rounded-xl overflow-hidden neuromorphism text-lg">
                                <div class="absolute hidden text-sm text-white font-bold border border-white top-2 left-2">
                                    <span class="bg-orange-500 px-2 py-1">Just Launched</span>
                                    <span class="bg-yellow-700 px-2 py-1">14<sup>th</sup> Sept</span>
                                </div>
                                <div>
                                    <img src="<?php echo $row['image_url'] ?>" alt="" class="w-80 h-48">
                                </div>
                                <div class="flex flex-col p-6 gap-2 bg-slate-300">
                                    <p><?php echo $row['make'] ?> <?php echo $row['model'] ?></p>
                                    <p class="font-bold">Rs.
                                        <?php
                                        $price = $row['price'];
                                        if ($price < 10000000) {
                                            echo $price / 100000, " Lakh";
                                        } else {
                                            echo $price / 10000000, ' Cr';
                                        }
                                        ?>
                                        <small class="text-gray-600">onwards</small>
                                    </p>
                                    <a href="./car.php?car_id=<?php echo $row['car_id'] ?>" class="btn-animate px-4 w-max py-2 border border-blue-500 rounded-md bg-slate-50 text-blue-500 "><span>Show Details</span></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="all-brands featured px-32 py-10 flex flex-col gap-10">
            <h2 class="text-4xl font-bold text-slate-800 mx-16 border-l-[6px] px-4 py-3 border-l-blue-500">
                All brands
            </h2>
            <?php
            $car_list = ['Maruti-Suzuki', 'Tata', 'Mercedes', 'Toyota', 'Audi', 'Volkswagen', 'Honda', 'Skoda', 'Bugatti', 'Nissan'];
            ?>
            <div class="all-brands-container mx-20">
                <div class="brands-list grid grid-cols-5 w-full ">
                    <?php
                    foreach ($car_list as $car) {
                    ?>
                        <a href="./brand.php?brand=<?php echo $car ?>" class="group brand-1 gap-2 text-slate-800 hover:bg-blue-400 duration-300 flex-col border border-blue-400 p-4 bg-white h-max flex items-center justify-center">
                            <img src="./assets/images/<?php echo $car ?>.jpg" class="w-40 duration-300 mix-blend-multiply cursor-pointer" alt="">
                            <p class="w-max group-hover:scale-110 duration-300 group-hover:text-white"><?php echo $car ?></p>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="latest-updates px-32 py-10 flex flex-col gap-10">
            <h1 class="text-4xl font-bold text-slate-800 mx-16 border-l-[6px] px-4 py-3 border-l-blue-500">Latest Car Updates</h1>
            <div class="latest-updates-container" id="news-container">
                <?php include('./components/loader.php') ?>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php') ?>
    <script src="./assets/js/news.js"></script>
</body>

</html>