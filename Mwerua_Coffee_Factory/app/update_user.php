<?php
include_once "../app/include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: User</title>
</head>
<body>
<?php include_once "../app/include/sidenav.php"?>
<section class="main_content">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-9">
            <div class="card">
                <h5 class="card-header text-center">Update User</h5>
                <div class="card-body">
                    <?php foreach (fetch_user() as $user): ?>
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="update_user_id" id="update_user_id" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required value="<?= $user['first_name'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required value="<?= $user['last_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" class="form-control" min="1960-01-01" max="2000-01-01" required value="<?= $user['date_of_birth'] ?>">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="id_number">ID Number</label>
                                        <input type="number" name="id_number" id="id_number" placeholder="ID Number" class="form-control" required value="<?= $user['national_id'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required value="<?= $user['phone_number'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required value="<?= $user['email_address'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_user" id="update_user" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
