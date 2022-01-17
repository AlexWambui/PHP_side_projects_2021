<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Dashboard</title>
</head>
<body>
<?php include_once "include/navbar.php"; ?>
<main class="main_content dashboard">
    <div class="container">
        <div class="row justify-content-center dashboard_content_wrapper">
            <div class="col-3 dashboard_content">
                <h1><span class="icon-shopping-basket"></span> Purchases</h1>
                <p>Total purchases: <?= total_purchases() ?></p>
<!--                <p>Purchases Today: --><?//= purchases_today() ?><!--</p>-->
            </div>
            <div class="col-3 dashboard_content">
                <h1><span class="icon-attach_money"></span> Sales</h1>
                <p>Total sales: <?= total_sales() ?></p>
            </div>
            <div class="col-3 dashboard_content">
                <h1><span class="icon-money"></span> Profit</h1>
                <p>Total profit: <?= total_sales() - total_purchases() ?></p>
            </div>
        </div>
    </div>
</main>
</body>
</html>