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
<body onload="window.print()">
<main>
    <div class="container report">
        <?php foreach(fetch_user_payment() as $payment): ?>
        <div class="report_header">
            <h1 class="text-center">Mwerua Coffee Factory</h1>
            <h1 class="text-center">Management System</h1>
            <p>Date: <?= date('d-m-Y') ?></p>
            <p>Report ID: <?= 'MCFR'.rand(40000, 5000) ?></p>
        </div>
        <div class="report_body">
            <p>Names: <span><?= $payment['first_name'].' '.$payment['last_name'] ?></span></p>
            <p>Email: <span><?= $payment['email_address'] ?></span></p>
            <p>Amount (Kgs): <span><?= $payment['amount_in_kgs'] ?></span></p>
            <p>Earned: <span><?= $payment['amount_in_kgs'] * 100 ?></span></p>
            <p>Payment Status: <span class="text-danger payment_status"><?= $payment['payment_status'] ?></span></p>
        </div>
        <div class="report_footer">
            <p>Served by <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
            <p>Email: <?= $_SESSION['email'] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>