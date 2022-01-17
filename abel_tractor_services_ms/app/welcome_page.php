<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Home Page</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="dashboard">
    <div class="container pt-5">
        <h5 class="text-center"><?= greet_user() ?></h5>
        <hr>
        <div class="row justify-content-center">
            <div class="col dashboard_content">
                <h4 class="heading">services</h4>
                <p>Available Services: <?= count_all('services') ?></p>
                <a href="tractors.php" class="stretched-link"></a>
            </div>
            <div class="col dashboard_content">
                <h4 class="heading">Requests</h4>
                <?php if($_SESSION['user_level'] == 1): ?>
                    <p>Requests made: <?= count_user_requests() ?></p>
                <?php endif; ?>
                <?php if($_SESSION['user_level'] == 2): ?>
                <p>Total Requests: <?= count_all('requests') ?></p>
                <?php endif; ?>
                <?php if($_SESSION['user_level'] == 1): ?>
                    <p>Pending requests: <?= count_user_pending_requests() ?></p>
                <?php endif; ?>
                <?php if($_SESSION['user_level'] == 2): ?>
                    <p>Pending requests: <?= count_all_pending_requests() ?></p>
                <?php endif; ?>
                <a href="requests.php" class="stretched-link"></a>
            </div>
            <?php if($_SESSION['user_level'] == 2): ?>
                <div class="col dashboard_content">
                    <h4 class="heading">Users</h4>
                    <p>Total registered users: <?= count_all('users') ?></p>
                    <a href="user.php" class="stretched-link"></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>

