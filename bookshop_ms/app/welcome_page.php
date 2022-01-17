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
<?php include_once "include/navbar.php"; ?>
<main class="main_content dashboard">
    <div class="container">
        <div class="row justify-content-center dashboard_content_wrapper">
            <div class="col-2 dashboard_content">
                <h1><span class="icon-book"></span> Books</h1>
                <p>Total no. of books: <?= count_all('books') ?></p>
            </div>
            <div class="col-2 dashboard_content">
                <h1><span class="icon-shopping-cart"></span> Sales</h1>
                <p>Total sales: <?= calculate_total_sales() ?></p>
            </div>
        </div>
    </div>
</main>
</body>
</html>