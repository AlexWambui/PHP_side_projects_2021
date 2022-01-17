<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Receipt</title>
</head>
<!--<body class="bg-light" onload="window.print()">-->
<body class="bg-light">
<main>
    <div class="container text-dark">
        <div class="row justify-content-center">
            <?php foreach (fetch_this_sale() as $sale): ?>
                <div class="col-6 mt-4">
                    <div class="receipt_wrapper">
                        <div class="receipt_header text-center">
                            <h5 class="text-center">################# Receipt #################</h5>
                            <div class="row">
                                <div class="col">
                                    <p>Date: <?= date('Y-m-d') ?></p>
                                </div>
                                <div class="col">
                                    <p>REF: <?= 'CafeM'.rand(1000, 10000) ?></p>
                                </div>
                                <div class="col">
                                    <p>Paid Via: <?php if($sale['payment_method'] == 1) echo 'Cash'; else echo 'Mpesa'; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="receipt_body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Meal</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $sale['meal_name'] ?></td>
                                    <td><?= $sale['quantity'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['quantity'] * $sale['price'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center total_price" colspan="4"><b>TOTAL: <?= $sale['quantity'] * $sale['price'] ?></b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="receipt_footer text-center">
                            <p>You were served by: <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
                            <p>Thank you and Welcome Again!!!</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
</body>
</html>

