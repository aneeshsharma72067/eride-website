<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conact</title>
    <?php include './components/cdnlinks.php' ?>

</head>

<body class="bg-slate-200">
    <?php include('./components/navbar.php') ?>
    <div class="flex gap-3 w-3/5 mx-auto my-10 bg-blue-950 px-10 py-7 rounded-2xl">
        <div class="flex flex-col gap-2 flex-1">
            <h1 class="text-5xl font-bold text-slate-100">Have a Query ?</h1>
            <p class="text-base text-slate-300 my-4">We're here to help! If you have a question, need assistance, or just want to get in touch, don't hesitate to reach out to us. Our dedicated support team is ready to provide you with the information and assistance you need.</p>
            <div class="flex flex-col gap-6 text-slate-300">
                <a href="tel:+0000000000" class="flex gap-5 duration-200 hover:text-slate-50 group hover:fill-slate-50">
                    <span class="flex items-center justify-center"><svg width="25" height="25" fill="#a8b2c5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-slate-50 duration-200">
                            <path d="M18.327 22.5c-.915 0-2.2-.331-4.125-1.407-2.34-1.312-4.15-2.524-6.478-4.846-2.245-2.243-3.337-3.695-4.865-6.476C1.132 6.63 1.426 4.984 1.755 4.28c.392-.842.97-1.345 1.718-1.844a8.263 8.263 0 0 1 1.343-.712l.13-.057c.231-.105.583-.263 1.028-.094.297.112.562.34.978.75.852.84 2.015 2.71 2.445 3.63.288.619.479 1.028.48 1.486 0 .537-.27.95-.598 1.397l-.182.242c-.356.469-.435.604-.383.846.104.486.884 1.933 2.165 3.212 1.281 1.278 2.686 2.008 3.174 2.112.253.054.39-.027.875-.397.069-.053.14-.107.215-.162.5-.372.894-.635 1.418-.635h.003c.456 0 .847.198 1.493.524.844.426 2.771 1.575 3.616 2.427.412.415.64.679.753.976.169.447.01.797-.094 1.031l-.057.129a8.27 8.27 0 0 1-.716 1.34c-.499.745-1.004 1.322-1.846 1.714a3.16 3.16 0 0 1-1.386.304Z"></path>
                        </svg></span>
                    <span>+91 XXXXXXXXXX</span>
                </a>
                <a href="mailto:@xyz@gmail.com" class="flex gap-5 duration-200 hover:text-slate-50 group hover:fill-slate-50">
                    <span><svg width="25" height="25" fill="#a8b2c5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-slate-50 duration-200">
                            <path d="M19.875 3.75H4.125A2.628 2.628 0 0 0 1.5 6.375v11.25a2.628 2.628 0 0 0 2.625 2.625h15.75a2.627 2.627 0 0 0 2.625-2.625V6.375a2.627 2.627 0 0 0-2.625-2.625Zm-.665 4.342-6.75 5.25a.75.75 0 0 1-.92 0l-6.75-5.25a.75.75 0 1 1 .92-1.184L12 11.8l6.29-4.892a.75.75 0 0 1 .92 1.184Z"></path>
                        </svg></span>
                    <span>xyz@gmail.com</span>
                </a>
            </div>
        </div>
        <div class="flex-1 relative flex items-center justify-center">
            <img src="./assets/images/blob.svg" alt="Not Found" class="absolute z-0">
            <img src="./assets/images/three-cars-banner.png" alt="Not Found" class="z-10">
        </div>
    </div>
    <?php include('./components/footer.php') ?>
</body>

</html>