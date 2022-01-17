<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_user_btn'])) update_user_level();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: User</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <?php foreach (fetch_this_row('users') as $user): ?>
                <div class="card">
                    <div class="card-header">
                        <h5>update: <?= $user['first_name'] . ' ' . $user['last_name'] ?></h5>
                    </div>
                    <div class="card-body">
                        <form action="./update_user.php" method="post" autocomplete="off">
                            <input type="hidden" name="update_id" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <label for="user_level">User Level</label>
                                <select name="user_level" id="user_level" class="form-control">
                                    <option value="<?= $user['user_level'] ?>">
                                        <?php
                                        if ($user['user_level'] == 1) echo 'Teacher';
                                        elseif ($user['user_level'] == 2) echo 'HOD';
                                        else echo 'admin';
                                        ?>
                                    </option>
                                    <option value="1">Teacher</option>
                                    <option value="2">HOD</option>
                                    <option value="3">Admin</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_user_btn" id="update_user_btn"
                                        class="btn btn-success">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
</html>
