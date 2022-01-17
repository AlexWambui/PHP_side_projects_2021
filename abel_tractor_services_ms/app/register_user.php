<?php
include_once "include/functions.php";
if (isset($_POST['register_user_btn'])) signup_user();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Signup</title>
</head>
<body>
<main class="index_page">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col app_intro text-center">
                <h1>Abel Tractor Services</h1>
                <img src="../assets/images/system_images/tractor.jpg" alt="tractor image">
                <p><i>Farming services have never been this easily accessible.</i></p>
            </div>
            <div class="col login_form_container">
                <h4 class="_header text-center">Signup</h4>
                <?= alert() ?>
                <form action="register_user.php/" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name"
                                       class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                       class="form-control" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number"
                               class="form-control" required autofocus>
                    </div>
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
                        <button type="submit" name="register_user_btn" id="register_user_btn" class="login_btn">Signup</button>
                        <p class="mt-2">Already have an account? <a href="../index.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>