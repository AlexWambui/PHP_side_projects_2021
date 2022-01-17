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
<h1 class="text-center"><?= greet_user() ?></h1>
    <div class="container">
        <div class="row">
            <div class="col border border-dark">
                <h5>Classes</h5>
                <p><?= count_all('classes') ?></p>
            </div>
            <div class="col border border-dark">
                <h5>Subjects</h5>
                <p><?= count_all('subjects') ?></p>
            </div>
            <div class="col border border-dark">
                <h5>Students</h5>
                <p><?= count_all('students') ?></p>
            </div>
        </div>
    </div>
</main>
</body>
</html>
