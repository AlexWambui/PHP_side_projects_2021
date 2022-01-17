<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Users</title>
</head>
<body>
<?php include_once "include/sidenav.php" ?>
<div class="main_content">
    <div class="card">
        <h5 class="card-header text-center _card_header"><?= count_users() ?> Users</h5>
        <div class="card-body">
            <table class="table table-hover" id="data_table">
                <thead>
                <tr>
                    <th>Names</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>ID Number</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (display_all_users() as $user): ?>
                    <tr>
                        <td><?= $user['first_name'].' '.$user['last_name'] ?></td>
                        <td><?= $user['email_address'] ?></td>
                        <td><?= $user['phone_number'] ?></td>
                        <td><?= $user['national_id'] ?></td>
                        <td>
                            <div class="row">
                                <div class="col justify-content-center">
                                    <!--                                    <a href="" class="" data-toggle="modal" data-target="#modalUpdatePayment"><span class="text-success table_icons icon-pencil"></span></a>-->
                                    <form action="update_user.php" method="post">
                                        <input type="hidden" name="update_id" value="<?= $user['id']; ?>">
                                        <button class="btn btn-link btn-sm " type="submit" name="edit_user"><span class="text-success table-icons icon-pencil"></span></button>
                                    </form>
                                </div>
<!--                                |-->
<!--                                <div class="col justify-content-center">-->
<!--                                    <form action="include/functions.php" method="post" class="form-inline">-->
<!--                                        <input type="hidden" name="user_id" id="user_id" value="--><?//=$user['id']?><!--">-->
<!--                                        <button type="submit" name="delete_user" class="btn btn-sm"><span class="text-danger table_icons icon-trash"></span></button>-->
<!--                                    </form>-->
<!--                                </div>-->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>
