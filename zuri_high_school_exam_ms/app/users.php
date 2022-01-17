<?php
include_once "include/functions.php";
protect_page();
admin_page();
if (isset($_POST['activate_user'])) update_user_status('active');
if (isset($_POST['transferred_user'])) update_user_status('transferred');
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Users</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<div class="main_content">
    <div class="container">
        <?= alert() ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5><?= count_all('users') ?> Users</h5>
                    </div>
                    <div class="col text-right">
                        <h5>Active: <?= count_user_status('active') ?></h5>
                    </div>
                    <div class="col text-right">
                        <h5>Transferred: <?= count_user_status('transferred') ?></h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover" id="data_table">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>User Level</th>
                        <?php if ($_SESSION['user_level'] == 3): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all('users') as $user)
                    {
                        ?>
                        <tr class="<?php if ($user['user_level'] == 3) echo 'text-success' ?>">
                            <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                            <td><?= $user['email_address'] ?></td>
                            <td><?= $user['phone_number'] ?></td>
                            <td><?= $user['status'] ?></td>
                            <td>
                                <?php
                                if ($user['user_level'] == 1) echo 'Teacher';
                                elseif ($user['user_level'] == 2) echo 'HOD';
                                else echo 'admin';
                                ?>
                            </td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <?php if ($_SESSION['user_level'] == 3): ?>
                                        <div class="action_buttons">
                                            <form action="update_user.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $user['id']; ?>">
                                                <button class="btn btn-link btn-sm " type="submit"
                                                        name="edit_user"><span
                                                            class="text-success table-icons icon-pencil"></span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="action_buttons">
                                            <form action="./users.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $user['id']; ?>">
                                                <button class="btn btn-info btn-sm " type="submit"
                                                        name="activate_user"><span
                                                            class="icon-check-circle"></span> Activate
                                                </button>
                                            </form>
                                        </div>
                                        <div class="action_buttons">
                                            <form action="./users.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $user['id']; ?>">
                                                <button class="btn btn-warning btn-sm " type="submit"
                                                        name="transferred_user"><span
                                                            class="icon-times-circle"></span> Transferred
                                                </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>
