<?php
session_start();
include('./components/conn.php');
if (!isset($_SESSION['user_id'])) {
    header('location: ./login.php');
    die();
}

if (!isset($_GET['car_brand']) || !isset($_GET['car_model'])) {
    header('location: ' . $_SERVER['HTTP_REFERER']);
    die();
}
$car_brand = $_GET['car_brand'];
$car_model = $_GET['car_model'];

$query = "SELECT * FROM cars WHERE make = '$car_brand' AND model = '$car_model'";
$result = mysqli_query($conn, $query);
if (!$result) {
    header('location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

if (mysqli_num_rows($result) == 0) {
    header('location: ./');
    die();
}
$car = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order | <?php echo $car_brand ?> <?php echo $car_model ?></title>
    <?php include('./components/cdnlinks.php') ?>

</head>

<body>
    <?php include('./components/navbar.php') ?>
    <div class="w-full px-32 py-10 flex flex-col gap-8 mb-20">
        <h1 class="text-5xl font-bold border-l-8 border-blue-600 pl-5 py-3 text-blue-950">Book Your Dream Car</h1>
        <div class="flex w-full gap-7">
            <div class="w-full flex flex-1 flex-col gap-5">
                <img src="<?php echo $car['image_url'] ?>" alt="" class="w-4/5">
                <h1 class="text-4xl px-10 font-bold text-slate-700"><?php echo $car_brand ?> <?php echo $car_model ?></h1>
            </div>
            <div class="flex-1">
                <form action="./api/hande-transaction.php" method="post" class="flex flex-col gap-6">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="car_id" hidden class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $car['car_id'] ?>">
                        <input type="text" name="first_name" placeholder="Your First Name" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $_SESSION['first_name'] ?>">
                        <input type="text" placeholder="Your Last Name" name="last_name" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $_SESSION['last_name'] ?>">
                        <input type=" email" placeholder="Email Address" name="email" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $_SESSION['email'] ?>">
                        <input type=" text" placeholder="Phone Number" name="phone" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $_SESSION['phone'] ?>">
                        <input type=" text" placeholder="Your Address" name="address" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800" value="<?php echo $_SESSION['address'] ?>">
                        <select name="month" id="month" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800">
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo date('F', strtotime("2023-$i-1")) ?></option>
                            <?php  } ?>
                        </select>
                        <select name="year" id="year" class="outline-none border border-slate-500 px-5 py-2 font-lg text-slate-800">
                            <?php for ($i = 0; $i <= 20; $i++) { ?>
                                <option value="<?php echo date("Y") + $i ?>"><?php echo date("Y") + $i ?></option>
                            <?php  } ?>
                        </select>

                    </div>
                    <button class="bg-blue-900 hover:bg-blue-950 duration-300 active:scale-90 px-8 py-3 text-lg text-slate-100 rounded-md w-max">Book My Car</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php') ?>

</body>

</html>