<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Update_Vehicle</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7 mt-5">
                <?php foreach(this_vehicle() as $vehicle): ?>
                <div class="receipt">
                    <div class="receipt_header">
                        <div class="app_name">
                            <p>Ngong Stage Parking</p>
                            <p>Payment system</p>
                        </div>
                        <div class="extra_receipt_header_details">
                            <p>Date: <?= date('d-m-Y') ?></p>
                            <p>Receipt id: <?= 'NS'.rand(1000, 5000) ?></p>
                        </div>
                    </div>
                    <div class="receipt_body">
                        <p>Registration Number: <?= $vehicle['registration_number'] ?></p>
                        <p>Time in: <?= $vehicle['arrival_time'] ?></p>
                        <p>Time out: <?= $vehicle['departure_time'] ?></p>
                        <p>Amount (Ksh): <?= round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2) ?></p>
                    </div>
                    <div class="receipt_footer">
                        <p>You were served by: <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
                        <p>Welcome Again!</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>