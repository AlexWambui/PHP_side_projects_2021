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
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <h5 class="text-center"><i>Dashboard</i></h5>
    </div>
    <div class="container dashboard_container">
        <?php if($_SESSION['user_level'] == 3): ?>
        <div class="dashboard_content">
            <h1>Users</h1>
            <p>Admins: <?= count_all_user_level('3') ?></p>
            <p>Maids: <?= count_all_user_level('1') ?></p>
            <p>Maid Seekers: <?= count_all_user_level('2') ?></p>
            <p class="dashboard_footer">Total: <?= count_all('users') ?></p>
        </div>
        <?php endif; ?>
        <div class="dashboard_content">
            <h1>Jobs</h1>
            <p>Job Openings: <?= count_job_openings() ?></p>
            <?php if($_SESSION['user_level'] == 2): ?>
            <p>Your posts: <?= count_users_jobs() ?></p>
            <?php endif; ?>
            <p class="dashboard_footer">Total Jobs: <?= count_all('jobs') ?></p>
        </div>
        <?php if($_SESSION['user_level'] != 3): ?>
        <div class="dashboard_content">
            <h1>Job Applications</h1>
            <?php if($_SESSION['user_level'] == 1): ?>
            <p>Sent: <?= count_user_job_applications() ?></p>
            <?php endif; ?>
            <?php if($_SESSION['user_level'] == 2): ?>
            <p>Total: <?= count_maid_seekers_job_applications() ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>