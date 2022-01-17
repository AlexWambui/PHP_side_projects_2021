<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Document</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <h1 class="text-center"><?= greet_user() ?></h1>
        <div class="row  dashboard justify-content-center">
            <div class="col dashboard_content">
                <h5><span class="icon-money"></span> Sales</h5>
                <p>Sales Today: <?= count_sales_today() ?></p>
                <p>Total Sales: <?= count_all('sales') ?></p>
            </div>
            <div class="col dashboard_content">
                <h5><span class="icon-spoon"></span> Meals</h5>
                <p>Available Meals: <?= count_all('meals') ?></p>
            </div>
            <div class="col dashboard_content">
                <h5><span class="icon-attach_money"></span> Profits</h5>
                <p>Profits Today: <?= profit_today() ?></p>
                <p>Total Profits: <?= total_profit() ?></p>
            </div>
        </div>
<!--        <div class="container">-->
<!--            <h5 class="text-center">Meals Categories Summary</h5>-->
<!--            <p>Most Consumed Meal: --><?//= count_category_occurence('lunch') ?><!--</p>-->
<!--        </div>-->
    </div>
</main>
</body>
</html>