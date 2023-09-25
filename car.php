<?php session_start();
include('./components/conn.php');
if (!isset($_GET['car_id'])) {
    header('location: ./new-cars.php');
    die();
}
$car_id = $_GET['car_id'];
$query = "SELECT * FROM cars WHERE car_id = $car_id";
$result = mysqli_query($conn, $query) or die('Error in fetching Car Details');
$car = mysqli_fetch_assoc($result);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query2 = "SELECT * FROM transactions WHERE car_id = '$car_id' AND user_id = '$user_id'";

    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result2) > 0) {
        $ordered = true;
        $order = mysqli_fetch_assoc($result2);
    } else {
        $ordered = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $car['make'] ?> <?php echo $car['model'] ?></title>
    <?php include('./components/cdnlinks.php') ?>
</head>

<body class="bg-white">
    <?php include('./components/navbar.php') ?>
    <div class="px-32 py-10 w-full">

        <div class="flex flex-col px-5">
            <h1 class="text-5xl flex items-center gap-4 text-slate-700 m-10 mb-3 font-bold">
                <span><?php echo $car['make'] ?> <?php echo $car['model'] ?></span>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <?php
                    $userId = $_SESSION['user_id'];
                    $check_favorite = "SELECT * FROM favorites WHERE car_id = '$car_id' AND user_id = '$userId'";
                    $favorite_result = mysqli_query($conn, $check_favorite);
                    if (mysqli_num_rows($favorite_result) > 0) {
                    ?>
                        <span class="text-base cursor-pointer bg-red-400 px-3 py-2 rounded-md" id="favorite-btn" data-car_id="<?php echo $car['car_id'] ?>" data-handle="remove">Remove from Favorites</span>
                    <?php
                    } else {
                    ?>
                        <span class="text-base cursor-pointer bg-red-400 px-3 py-2 rounded-md" id="favorite-btn" data-car_id="<?php echo $car['car_id'] ?>" data-handle="add">Add to Favorites</span>
                    <?php
                    }
                    ?>


                <?php } ?>
            </h1>
            <h2 class="text-2xl text-slate-500 mx-10 mb-10"><?php echo DateTime::createFromFormat('!m', $car['month'])->format('F') . ' ' . $car['year'] ?></h2>
        </div>
        <div class="w-[90%] mx-auto flex gap-4">
            <div class="flex flex-col gap-3 flex-1">
                <img src="<?php echo $car['image_url'] ?>" alt="">
                <p class="text-lg text-slate-600 my-3"><?php echo $car['description'] ?></p>
            </div>
            <div class="flex-[0.5] flex flex-col gap-20 items-center pt-20">
                <img class="w-3/5" src="./assets/images/<?php echo $car['make'] ?>.jpg" alt="">
                <div class="flex flex-col gap-4 bg-slate-200 px-10 py-5">
                    <h2 class="text-xl text-slate-500">Specifications</h2>
                    <hr class="border-slate-400 my-2">
                    <div class="flex text-lg gap-10 items-center justify-between">
                        <span class="text-slate-700">Fuel Type</span>
                        <span class="text-blue-500"><?php echo $car['type'] ?></span>
                    </div>
                    <hr class="border-slate-400 my-2">
                    <div class="flex text-lg items-center justify-between">
                        <span class="text-slate-700">Mileage</span>
                        <span class="text-blue-500"><?php echo $car['mileage'] ?></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex flex-col my-10 gap-5 mx-auto px-10 py-6 w-[90%]">
            <div class="flex flex-col mx-auto px-10 py-6 gap-5 border rounded-xl bg-blue-950 border-slate-800 w-full">
                <h1 class="text-3xl font-bold text-slate-200"><?php echo $car['model'] ?> Price</h1>
                <div class="flex items-center gap-6">
                    <p class="text-4xl text-white font-semibold">₹ <?php
                                                                    $price = $car['price'];
                                                                    if ($price < 10000000) {
                                                                        echo $price / 100000, " Lakh";
                                                                    } else {
                                                                        echo $price / 10000000, ' Cr';
                                                                    }
                                                                    ?>
                        -
                        <?php
                        $price = $car['max_price'];
                        if ($price < 10000000) {
                            echo $price / 100000, " Lakh";
                        } else {
                            echo $price / 10000000, ' Cr';
                        }
                        ?></p>
                </div>
            </div>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <?php if (!$ordered) { ?>
                    <a href="./order.php?car_brand=<?php echo $car['make'] ?>&car_model=<?php echo $car['model'] ?>" class="cursor-pointer bg-red-400 outline-none text-white font-bold border border-white duration-300 hover:text-red-500 hover:border-red-400 hover:bg-white text-lg rounded-md px-10 py-3 w-max">Book Now !</a>
                <?php } else { ?>
                    <span id="see-order" class="cursor-pointer bg-red-400 outline-none text-white font-bold border border-white duration-300 hover:text-red-500 hover:border-red-400 hover:bg-white text-lg rounded-md px-10 py-3 w-max">See Booking Details</span>
                    <div class="text-base text-slate-500">
                        <span>You booked this car on </span>
                        <span class="font-semibold"><?php echo date('d F Y', strtotime($order['transaction_date'])) ?></span>
                    </div>
                    <div id="order-details" class="opacity-0 translate-x-1/2 -z-10 duration-200 fixed w-[70vw] top-24 rounded-lg h-[80vh] bg-gradient-to-br from-red-300 to-blue-300 px-20 py-16 border-[0_0_15px_black]">
                        <button id="close-details" class="absolute flex items-center justify-center right-4 rounded-lg top-4 bg-white">
                            <svg width="45" height="45" fill="none" stroke="#fc8888" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.25 17.25 6.75 6.75"></path>
                                <path d="m17.25 6.75-10.5 10.5"></path>
                            </svg>
                        </button>
                        <div class="w-4/5 flex flex-col gap-9">
                            <h1 class="text-4xl font-bold border-l-8 border-blue-500 pl-6 py-3 text-slate-700">Booking Details</h1>
                            <div class="flex flex-col gap-5 text-2xl text-slate-800">
                                <div>
                                    <span class="font-semibold">Car : </span>
                                    <span><?php echo $car['make'] ?> <?php echo $car['model'] ?></span>
                                </div>
                                <div>
                                    <span class="font-semibold">Showrooom Location : </span>
                                    <span>Showroom xyz</span>
                                </div>

                                <div>
                                    <span>Booked for the Month </span>
                                    <span class="font-semibold"><?php echo date('F', strtotime("1-" . $order["month"] . "-2003")) ?></span>
                                    <span class="font-semibold">In <?php echo $order['year'] ?></span>
                                </div>
                                <div class="text-xl">
                                    <span>You booked this car on </span>
                                    <span class="font-semibold"><?php echo date('d F Y', strtotime($order['transaction_date'])) ?></span>
                                </div>
                                <a href="./api/cancel-booking.php?id=<?php echo $order['transaction_id'] ?>" class="px-5 py-3 bg-blue-900 rounded-md duration-300 hover:bg-blue-950 text-xl text-white w-max">Cancel Booking</a>

                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <a href="./order.php?car_brand=<?php echo $car['make'] ?>&car_model=<?php echo $car['model'] ?>" class="cursor-pointer bg-red-400 outline-none text-white font-bold border border-white duration-300 hover:text-red-500 hover:border-red-400 hover:bg-white text-lg rounded-md px-10 py-3 w-max">Book Now !</a>
            <?php } ?>
        </div>

        <div class="flex flex-col gap-14 my-10 w-[90%] mx-auto rounded-xl neuromorphism bg-slate-200 px-16 py-10">
            <h2 class="text-4xl text-slate-700 ">Pros and Cons of <?php echo $car['make'] . ' ' . $car['model'] ?> Car</h2>
            <div class="flex gap-10 items-center justify-center">
                <div class="bg-slate-400 rounded-full aspect-square flex-[0.15] flex items-center justify-center"><img src="./assets/images/star.png" alt="star" class=""></div>
                <div class="flex flex-col gap-5 flex-[0.85]">
                    <h3 class="text-xl flex gap-2 items-center text-slate-800">
                        <span class="h-1 w-20 rounded-full bg-red-400"></span>
                        <span>Our Experts</span>
                    </h3>
                    <div class="text-2xl text-slate-500"><?php echo $car['main_review'] ?></div>
                </div>
            </div>
            <?php
            $query_test = "SELECT * FROM expert_reviews WHERE car_id = '$car_id'";
            $result_test = mysqli_query($conn, $query_test);
            if (mysqli_num_rows($result_test) > 0) {
            ?>
                <div class="flex gap-10">
                    <?php
                    $query_1 = "SELECT review FROM expert_reviews WHERE car_id = '$car_id' AND type = 'positive'";
                    $result_1 = mysqli_query($conn, $query_1);
                    ?>
                    <div class="flex flex-col flex-1 gap-3 bg-green-100 px-10 py-8 rounded-xl">
                        <h2 class="text-xl text-slate-600">Things we Like</h2>
                        <ul class="color-bullet flex flex-col gap-1">
                            <?php while ($row = mysqli_fetch_assoc($result_1)) { ?>
                                <li>
                                    <span><?php echo $row['review'] ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php
                    $query_2 = "SELECT review FROM expert_reviews WHERE car_id = '$car_id' AND type = 'negative'";
                    $result_2 = mysqli_query($conn, $query_2);
                    ?>
                    <div class="flex flex-col flex-1 bg-red-100 gap-3 px-10 py-8 rounded-xl">
                        <h2 class="text-xl text-slate-600">Things we Don't Like</h2>
                        <ul class=" color-bullet-red color-bullet flex flex-col gap-1">
                            <?php while ($row = mysqli_fetch_assoc($result_2)) { ?>
                                <li><span><?php echo $row['review'] ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            <?php } ?>
        </div>
        <div class="my-6 py-10 flex flex-col gap-6 w-full">
            <h1 class="text-3xl font-bold text-slate-800">User Reviews</h1>
            <div class="flex items-center justify-center w-full flex-col bg-slate-300 px-4 py-2 rounded-xl">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $check_user_review = "SELECT * FROM user_reviews WHERE user_id='$user_id' AND car_id = '$car_id'";
                    $user_review_result = mysqli_query($conn, $check_user_review);
                    if (mysqli_num_rows($user_review_result) == 0) {
                ?>
                        <form id="review-form" class="w-full gap-5 flex flex-col items-end justify-center">
                            <textarea name="user-review" class="p-4 text-lg w-full border-2 rounded-xl border-blue-900 outline-none z-10" id="user-review" cols="30" rows="5" placeholder="Enter a review"></textarea>
                            <p class="review-error duration-300 -mt-20 px-5 py-2 border-red-600 border-2 bg-red-200 text-red-500 w-full rounded-lg">Please Enter a review</p>
                            <button id="review-submit" data-carid="<?php echo $car_id ?>" class="text-xl text-white px-5 py-2 rounded-lg bg-blue-600 outline-none cursor-pointer duration-300 hover:bg-blue-800 border-none ">Submit Review</button>
                        </form>
                <?php }
                } ?>
                <?php
                $get_user_reviews = "SELECT users.username, user_reviews.review FROM users INNER JOIN user_reviews ON users.user_id = user_reviews.user_id WHERE car_id='$car_id'";
                $reviews_result = mysqli_query($conn, $get_user_reviews);
                ?>
                <div class="reviews-list my-3 px-4 py-5 flex flex-col items-start w-full gap-2">
                    <?php while ($review = mysqli_fetch_assoc($reviews_result)) { ?>
                        <div class="flex flex-col gap-2 border-l-4 w-full border-blue-500 bg-slate-50 pl-7 py-3 ">
                            <p class="font-bold text-base text-blue-900">@<?php echo $review['username'] ?></p>
                            <p class="text-lg text-zinc-800"><?php echo $review['review'] ?></p>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
    <?php include('./components/footer.php') ?>
    <script src="./assets/js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#favorite-btn', function() {
                var car_id = $(this).data('car_id');
                var handleType = $(this).data('handle');
                var button = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'api/handle-favorite.php',
                    data: {
                        carId: car_id,
                        handle: handleType
                    },
                    success: function(res, status, xhr) {
                        console.log("Response :", res, '\n', 'HandleType:', handleType, '\n', "Status :", status);
                        if (res === 'success') {
                            if (handleType === 'add') {
                                button.text("Remove from Favorites");
                                button.data('handle', 'remove')
                            } else if (handleType === 'remove') {
                                button.text("Add to Favorites");
                                button.data('handle', 'add')
                            }
                        } else {
                            alert('Failed, No response')
                            console.log(res, status, xhr)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error :", error, '\n', 'HandleType:', handleType, '\n', "Status :", status);
                        alert('error in adding to favorites');
                        console.log(xhr, status, error);
                    }
                })
            })
            $('#see-order').click(() => {
                $('#order-details').removeClass('translate-x-1/2 opacity-0 -z-10');
                $('#order-details').addClass('translate-x-0 z-10');
            })
            $('#close-details').click(() => {
                $('#order-details').addClass('translate-x-1/2 opacity-0 -z-10');
                $('#order-details').removeClass('translate-x-0 z-10');
            })
            $(document).on('click', '#review-submit', function(event) {
                event.preventDefault();
                var review = $('#user-review').val();
                var car_id = $(this).data('carid');
                if (review === '') {
                    $('.review-error').removeClass('-mt-20')
                    setTimeout(() => {
                        $('.review-error').addClass('-mt-20')
                    }, 4000);
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: 'api/user-review.php',
                    data: {
                        carId: car_id,
                        review: review
                    },
                    success: function(res, status, xhr) {
                        console.log(JSON.parse(res), status);
                        if (JSON.parse(res) === "success") {
                            console.log('success in adding review')
                            const newReview = `<div class="flex flex-col gap-2 border-l-4 w-full border-blue-500 bg-slate-50 pl-7 py-3 ">
                                <p class="font-bold text-base text-blue-900"><?php echo $_SESSION['username'] ?></p>
                                <p class="text-lg text-zinc-800">${review}</p>
                            </div>`
                            $('.reviews-list').append(newReview);
                            $('#review-form').addClass('hidden');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
</body>

</html>