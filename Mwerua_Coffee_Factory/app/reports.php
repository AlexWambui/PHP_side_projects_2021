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
<?php include_once "include/sidenav.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Reports</h5>
                            </div>
                            <div class="col text-right">
                                <p>Unpaid: <?= count_unpaid() ?></p>
                            </div>
                            <div class="col text-right">
                                <p>paid: <?= count_paid() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Names</th>
                                <th>Date collected</th>
                                <th>Amount in Kgs</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <?php foreach(fetch_payments() as $payment) :?>
                                <tbody>
                                <tr>
                                    <td><?= $payment['first_name'].' '.$payment['last_name'] ?></td>
                                    <td><?= $payment['date_collected'] ?></td>
                                    <td><?= $payment['amount_in_kgs'] ?></td>
                                    <td><?= $payment['amount_in_kgs'] * 100 ?></td>
                                    <td <?php if($payment['payment_status'] == '-') echo 'class="text-danger"' ?>><?= $payment['payment_status'] ?></td>
                                    <td>
                                        <div class="action_container">
                                            <div class="action">
                                                <form action="include/functions.php" method="post">
                                                    <input type="hidden" name="payment_id" value="<?= $payment['payment_id'] ?>">
                                                    <button class="btn btn-info" name="pay_user"><span class="icon-money"></span> Paid</button>
                                                </form>
                                            </div>
                                            <div class="action">
                                                <form action="payments_report.php">
                                                    <input type="hidden" name="payment_id" value="<?= $payment['payment_id'] ?>">
                                                    <button class="btn btn-warning btn-sm" name="print_payment_report"><span class="icon-print2"></span> Print</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>