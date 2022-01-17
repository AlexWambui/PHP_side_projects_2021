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
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title>Abel Tractor Services</title>
</head>
<body>
<main class="index_page">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col app_intro text-center">
                <h1>Abel Tractor Services</h1>
                <img src="assets/images/system_images/tractor.jpg" alt="tractor image">
                <p>Supporting you through the production cycle.</p>
                <p><i>Farming services have never been this easily accessible.</i></p>
            </div>
            <div class="col login_form_container">
                <h4 class="_header text-center">Login</h4>
                <?= alert() ?>
                <form action="./" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="email_address">Email Address</label>
                        <input type="email" name="email_address" id="email_address" placeholder="Email Address"
                               class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control"
                               required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="login_btn" id="login_btn" class="login_btn">Login</button>
                        <p class="mt-2">Don't have an account? <a href="app/register_user.php">Signup</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<footer class="bg-dark text-center index_page_footer">
    <p class="text-light">&copy 08-10-2021</p>
</footer>
</body>
</html>