<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_request'])) add_service();
if (isset($_POST['update_request'])) update_request();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Requests</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <?php if ($_SESSION['user_level'] == 2): ?>
                                    <h5><?= count_all('requests') ?> Request(s)</h5>
                                <?php endif; ?>
                                <?php if ($_SESSION['user_level'] == 1): ?>
                                    <h5><?= count_user_requests() ?> Request(s)</h5>
                                <?php endif; ?>
                            </div>
                            <div class="col text-right">
                                <?php if ($_SESSION['user_level'] == 1): ?>
                                    <h5><?= count_user_pending_requests() ?> Pending</h5>
                                <?php endif; ?>
                                <?php if ($_SESSION['user_level'] == 2): ?>
                                    <h5 class="text-danger"><?= count_all_pending_requests() ?> Pending</h5>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <?php if ($_SESSION['user_level'] == 2): ?>
                                    <th>Names</th>
                                <?php endif; ?>
                                <th>Request</th>
                                <th>Date Required</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($_SESSION['user_level'] == 1)
                            {
                                users_requests_rows();
                            }
                            if ($_SESSION['user_level'] == 2)
                            {
                                admin_requests_rows();
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>