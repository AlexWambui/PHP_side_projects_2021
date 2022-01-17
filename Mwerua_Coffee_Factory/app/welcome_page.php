<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php"; ?>
    <title>Home</title>
</head>
<body>
<?php include_once "include/sidenav.php"; ?>
<div class="main_content dashboard">
    <div class="container">
        <div class="container text-center">
            <h5>Hi <?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></h5>
        </div>
        <hr>
        <div class="row">
            <div class="col dashboard_container">
                <h5 class="dashboard_container_header">Coffee Collection</h5>
                <div class="dashboard_container_body">
                    <p>Submitted: <?php if(calc_kgs_collected_by_user()<=0) echo 0; else echo calc_kgs_collected_by_user() ?> Kgs</p>
                    <p>Earned: <?php if(calc_user_earnings()<=0) echo 0; else echo calc_user_earnings() ?> Kshs</p>
                    <a href="payments.php" class="stretched-link"></a>
                </div>
            </div>
            <div class="col dashboard_container">
                <h5 class="dashboard_container_header">Payments Summary</h5>
                <div class="dashboard_container_body">
                    <p>Total Paid: <?= calc_user_earnings_paid() ?></p>
                    <p>Total Unpaid: <?= calc_user_earnings_unpaid() ?></p>
                </div>
            </div>
            <?php if($_SESSION['user_level'] == 2): ?>
            <div class="col dashboard_container">
                <h5 class="dashboard_container_header">Payments</h5>
                <div class="dashboard_container_body">
                    <p>Pending: <?= count_unpaid() ?></p>
                    <p>Paid: <?= count_paid() ?></p>
                    <a href="payments.php" class="stretched-link"></a>
                </div>
            </div>
            <div class="col dashboard_container">
                <h5 class="dashboard_container_header">Feedbacks</h5>
                <div class="dashboard_container_body">
                    <p>Pending: <?php if (count_unread_feedbacks()>=1) echo '<a href="feedbacks.php"><span class="text-warning">'.count_unread_feedbacks().'</span></a>'; else echo count_unread_feedbacks() ?></p>
                    <a href="feedbacks.php" class="stretched-link"></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>