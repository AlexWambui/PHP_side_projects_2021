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
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Reports</h5>
                            </div>
                            <div class="col text-right">
                                <h5>Sales Today: <?= count_sales_today() ?></h5>
                            </div>
                            <div class="col text-right">
                                <h5>Total Sales: <?= count_all('sales') ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table_bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Meal</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Payment Method</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all_sales() as $sale): ?>
                                <tr>
                                    <td><?= $sale['meal_name'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['quantity'] ?></td>
                                    <td>
                                        <?php
                                        if($sale['payment_method'] == 1) echo 'Cash';
                                        elseif($sale['payment_method'] == 2) echo 'MPesa';
                                        ?>
                                    </td>
                                    <td><?= $sale['price'] * $sale['quantity'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>