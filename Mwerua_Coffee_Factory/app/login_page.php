<!doctype html>
<html lang="en">
<head>
    <?php
    include_once "include/head_section.php";
    include_once "include/functions.php";
    if(isset($_POST['login_button'])) login();
    ?>
    <title>Login</title>
</head>
<body>
<section class="login_page row justify-content-center">
    <div class="col-lg-4">
        <div class="login_form_card card mt-5">
            <h4 class="card-header text-center _card_header">Login</h4>
            <div class="card-body text-center">
                <?= alert() ?>
                <form action="./login_page.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control mb-2" required autofocus>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control mb-2" required>
                        <button type="submit" name="login_button" id="login_button" class="btn btn-success">Login</button>
                        <hr/>
                        <p>Don't have an account? <a href="registration_page.php" class="mt-1">Signup</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>