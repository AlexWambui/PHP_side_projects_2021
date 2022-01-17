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
<body onload="window.print()">
<main>
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach (fetch_this_sale() as $sale): ?>
                <div class="col-6 mt-4">
                    <div class="receipt_wrapper">
                        <div class="receipt_header text-center">
                            <div class="row">
                                <div class="col">
                                    <p>Date: <?= date('Y-m-d') ?></p>
                                </div>
                                <div class="col">
                                    <p>REF: <?= 'BS'.rand(1000, 10000) ?></p>
                                </div>
                            </div>
                            <h5 class="text-center">Receipt</h5>
                        </div>
                        <div class="receipt_body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Item Details</th>
                                    <th>price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $sale['title'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center total_price" colspan="3"><b>TOTAL: <?= $sale['price'] ?></b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="receipt_footer text-center">
                            <p>You were served by: <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
                            <p>Email: <?= $_SESSION['email'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
</body>
</html>

