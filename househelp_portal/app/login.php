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
<main class="main_content">
    <div class="container account_page">
        <div class="row justify-content-center">
            <div class="col-5 mt-5">
                <div class="card text-dark">
                    <div class="card-header">
                        <h5 class="text-center">Login</h5>
                    </div>
                    <?= alert() ?>
                    <div class="card-body">
                        <form action="./login.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="account_btn" name="login_btn">Login</button>
                            </div>
                        </form>
                        <p class="text-center">Don't have an account? <a href="signup.php">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>