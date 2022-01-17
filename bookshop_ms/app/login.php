<?php
include_once "include/functions.php";
if (isset($_POST['login_btn'])) login();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Login</title>
</head>
<body>
<main class="login_page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Login</h5>
                    <?= alert() ?>
                    <div class="card-body">
                        <form action="./login.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autofocus>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" name="login_btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>