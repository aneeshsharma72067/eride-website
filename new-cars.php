<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Cars</title>
    <?php include('./components/cdnlinks.php') ?>
</head>

<body>
    <div class="flex flex-col">
        <?php include('./components/navbar.php') ?>
        <div class="slideIn mx-48 my-10 flex flex-col gap-6">
            <h1 class="text-4xl font-bold text-slate-800 border-l-[6px] px-4 py-3 border-l-blue-500">New Cars</h1>
            <div class="text-slate-500">
                Why choose a new car? With the latest advancements in safety, technology, and performance, you can expect a new car to provide you with unmatched reliability, fuel efficiency, and modern features. Plus, you'll enjoy that new car smell and the peace of mind that comes with a comprehensive warranty.
            </div>
        </div>
        <div class="slideIn all-brands featured px-28 py-10 flex flex-col gap-10">
            <h2 class="text-4xl font-bold text-slate-800 mx-20 border-l-[6px] px-4 py-3 border-l-blue-500">
                All brands
            </h2>
            <?php
            // echo ucwords(explode('-', 'maruti-suzuki')[0] . ' ' . explode('-', 'maruti-suzuki')[1])
            $brand_list = ['Maruti-Suzuki', 'Tata', 'Mercedes', 'Toyota', 'Audi', 'Volkswagen', 'Honda', 'Tesla', 'Bugatti', 'Nissan'];
            ?>
            <div class="all-brands-container mx-20">
                <div class="brands-list grid grid-cols-5 w-full ">
                    <?php
                    foreach ($brand_list as $brand) {
                    ?>
                        <a href="./brand.php?brand=<?php echo $brand ?>" class="group brand-1 gap-2 text-slate-800 hover:bg-blue-400 duration-300 flex-col border hover:border-white border-blue-400 p-4 bg-white h-max flex items-center justify-center">
                            <img src="./assets/images/<?php echo $brand ?>.jpg" class="w-40 h-24 duration-300 mix-blend-multiply cursor-pointer" alt="">
                            <p class="w-max group-hover:scale-110 duration-300 group-hover:text-white"><?php echo $brand ?></p>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="mx-40 my-10 flex flex-col gap-10">
            <h1 class="text-4xl font-bold text-slate-800 border-l-[6px] px-4 py-3 border-l-blue-500">
                Your Journey Starts Here: Car Listings
            </h1>
            <div class="flex flex-col gap-4">
                <h2 class="text-2xl text-slate-700">Filter</h2>
                <div class="flex flex-wrap gap-3 bg-slate-200 py-2 px-4">
                    <span onclick="getFilteredCarList(this)" data-filter_value="5" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 5 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="10" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 10 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="15" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 15 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="20" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 20 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="25" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 25 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="30" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 30 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="35" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 35 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="40" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Under 40 Lakh</span>
                    <span onclick="getFilteredCarList(this)" data-filter_value="1000000" class="border border-slate-300 bg-white px-4 hover:bg-slate-300 duration-200 cursor-pointer hover:border-white py-2">Clear Filter ×</span>

                </div>
            </div>
            <div id="car-list" class="w-full">
                <?php include('./components/loader.php') ?>

            </div>

        </div>
    </div>
    <?php include('./components/footer.php') ?>
    <script src="./assets/js/main.js"></script>

</body>

</html>