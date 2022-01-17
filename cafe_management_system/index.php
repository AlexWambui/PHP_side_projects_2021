<?php
include_once "app/include/functions.php";
if (isset($_POST['login_btn'])) login();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title>Cafe Point of Sale</title>
</head>
<body>
<main class="index_page">
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-5 index_page_contents">
                <h1>CAFE</h1>
                <p>Management System</p>
                <ul>
                    <li>Free & Reduced food management, reporting, and tracking</li>
                    <li>Billing, invoicing, collecting data and ensuring smooth order processing.</li>
                </ul>
            </div>
            <div class="col index_page_login_form">
                <div class="form_header text-center">
                    <h1>Login</h1>
                </div>
                <?= alert() ?>
                <form action="./index.php" method="post" autocomplete="off">
                    <input type="text" name="username" id="username" placeholder="Username" autofocus required>
                    <input type="password" name="password" id="username" placeholder="Password" required>
                    <div class="login_btn text-center">
                        <button type="submit" class="custom_btn" name="login_btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>
