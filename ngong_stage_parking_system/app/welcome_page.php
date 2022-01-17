<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Home Page</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="linear_gradient_image vh_88">
    <div class="container dashboard">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <h1 class="text-center">Hi <?= $_SESSION['first_name'] ?></h1>
                <div class="row">
                    <div class="col dashboard_wrapper">
                        <a href="vehicles.php" class="stretched-link">vehicles Today: <?= count_today_vehicles() ?></a>
                    </div>
                    <div class="col dashboard_wrapper">
                        <a href="vehicles.php" class="stretched-link">Amount Today (Ksh): <?= calc_total_amount_today() ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="vh_6 bg-dark">
    <p class="text-center text-light">&copy; 2021</p>
</footer>
</body>
</html>
