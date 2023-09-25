<?php
session_start();
include('./components/conn.php');
if (!isset($_SESSION['admin_id'])) {
    header('location: admin-login.php');
    die();
}

$car_id = $_GET['car_id'];
$get_car_query = "SELECT * FROM cars WHERE car_id = '$car_id'";
$result = mysqli_query($conn, $get_car_query);

if (!$result) {
    header('location: ./edit-car-form.php?res=400');
    die();
}

$car = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <?php include('./components/cdnlinks.php') ?>
</head>

<body class="bg-zinc-900">
    <div class="w-4/5 mx-auto my-8 flex items-start justify-center flex-col">
        <h1 class="text-4xl text-white bg-zinc-900 py-4 px-6 w-full border rounded-xl">Edit Car Details</h1>
        <form action="./api/edit-car.php" role="form" method="post" class="mt-10 mb-2 flex flex-col text-white bg-zinc-700 items-start justify-center gap-2 w-full py-4 rounded-xl">
            <div class="w-full flex flex-col px-10">
                <div class="flex justify-between w-full gap-10">
                    <div class="flex flex-col w-1/2">
                        <input type="text" hidden value="<?php echo $car['car_id'] ?>" name="car_id" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md " id="car_id">
                        <div class="flex flex-col py-2 justify-center gap-2">
                            <label for="make" class="text-xl">Make</label>
                            <input type="text" required value="<?php echo $car['make'] ?>" name="make" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md " id="make">
                        </div>
                        <div class="flex justify-between items-center gap-10">
                            <div class="flex flex-col w-full py-2 justify-center gap-2">
                                <label for="month" class="text-xl ">Month </label>
                                <input type="month" required value="<?php echo $car['year'] ?>-<?php if ($car['month'] < 10) {
                                                                                                    echo '0' . $car['month'];
                                                                                                } else {
                                                                                                    echo $car['month'];
                                                                                                } ?>" name="month" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="month">
                            </div>
                            <div class="flex flex-col w-full py-2 justify-center gap-2">
                                <label for="year" class="text-xl ">Year</label>
                                <input type="number" required value="<?php echo $car['year'] ?>" name="year" min="1900" max="2050" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="year">
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-10">
                            <div class="flex flex-col w-full py-2 justify-center gap-2">
                                <label for="mileage" class="text-xl ">Mileage</label>
                                <input type="number" value="<?php echo $car['mileage'] ?>" step="0.01" name="mileage" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="mileage">
                            </div>
                            <div class="flex flex-col w-full py-2 justify-center gap-2">
                                <label for="type" class="text-xl ">FuelType</label>
                                <select name="type" id="type" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none">
                                    <option value="">Select Fuel Type</option>
                                    <option <?php if ($car['type'] == 'Petrol') echo 'selected' ?> value="Petrol">Petrol</option>
                                    <option <?php if ($car['type'] == 'Diesel') echo 'selected' ?> value="Diesel">Diesel</option>
                                    <option <?php if ($car['type'] == 'Electric') echo 'selected' ?> value="Electric">Electric</option>
                                    <option <?php if ($car['type'] == 'Petrol | Diesel') echo 'selected' ?> value="Petrol | Diesel">Petrol | Diesel</option>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col w-1/2">
                        <div class="flex flex-col py-2 justify-center gap-2">
                            <label for="model" class="text-xl">Model</label>
                            <input type="text" required value="<?php echo $car['model'] ?>" name="model" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md " id="model">
                        </div>
                        <div class="flex justify-between items-center gap-10">
                            <div class="flex flex-col py-2 w-full justify-center gap-2">
                                <label for="price" class="text-xl ">Price</label>
                                <input type="number" name="price" required class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="price" value="<?php echo $car['price'] ?>">
                            </div>
                            <div class="flex flex-col w-full py-2 justify-center gap-2">
                                <label for="max-price" class="text-xl ">Max Price</label>
                                <input type="number" required name="max-price" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="max-price" value="<?php echo $car['max_price'] ?>">
                            </div>
                        </div>
                        <div class="flex flex-col py-2 justify-center gap-2">
                            <label for="image-url" class="text-xl ">Image URL</label>
                            <input type="text" name="image-url" value="<?php echo $car['image_url'] ?>" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border py-2 px-4 w-full rounded-md outline-none" id="image-url">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col py-2 justify-center gap-2">
                    <label for="description" class="text-xl">Description</label>
                    <textarea name="description" required id="description" cols="30" rows="10" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md"><?php echo $car['description'] ?></textarea>
                </div>
                <div class="flex flex-col py-2 justify-center gap-2">
                    <label for="main-review" class="text-xl">Expert Review</label>
                    <textarea name="main-review" id="main-review" cols="30" rows="10" class="text-white focus:shadow-[0_0_10px_#111] duration-300 bg-zinc-950 border-slate-500 border outline-none py-2 px-4 w-full rounded-md"><?php echo $car['main_review'] ?></textarea>
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

            <button class="py-5 px-10 mx-10 text-xl rounded-lg my-5 bg-green-500 hover:bg-green-600 duration-300">Edit Car Details</button>
        </form>
    </div>
</body>

</html>