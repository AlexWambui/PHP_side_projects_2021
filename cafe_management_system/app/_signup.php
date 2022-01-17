<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Signup</title>
</head>
<body>
<section class="login_page row justify-content-center">
    <div class="col-lg-8">
        <div class="login_form_card card mt-3">
            <h4 class="card-header text-center">Signup</h4>
            <div class="card-body">
                <form action="include/functions.php" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="username">User Name</label>
                                <input type="text" name="username" id="username" placeholder="User Name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="signup_btn" id="signup_btn" class="btn btn-success">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>