<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Reports</title>
</head>
<body onload="window.print()">
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach (fetch_user_request_print() as $request): ?>
            <div class="col-6 mt-4">
                <div class="report_wrapper">
                    <div class="report_header text-center">
                        <h1>Abel Tractor Services</h1>
                        <h1>Management System</h1>
                        <p>Date: <?= date('Y-m-d') ?></p>
                        <p>REF: <?= 'ABEL'.rand(1000, 10000) ?></p>
                    </div>
                    <div class="report_body">
                        <div class="row">
                            <div class="col">
                                <h5>User Details</h5>
                                <p>Names: <?= $request['first_name'].' '.$request['last_name'] ?></p>
                                <p>Email: <?= $request['email_address'] ?></p>
                                <p>Tel: <?= $request['phone_number'] ?></p>
                            </div>
                            <div class="col">
                                <h5>Request Details</h5>
                                <p>Requested: <?= $request['service_name'] ?></p>
                                <p>Amount: Kshs.<?= $request['price'] ?>/=</p>
                                <p>Approval:
                                    <?php
                                    if ($request['status'] == '-' || $request['status'] == 'rejected')
                                        echo '<span class="text-danger">Not Approved</span>';
                                    else if ($request['status'] == 'approved')
                                        echo '<span class="text-success">Approved</span>';
                                    else
                                        echo $request['status'];
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="report_footer">
                        <p>You were served by: <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
                        <p>Email: <?= $_SESSION['email'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>

