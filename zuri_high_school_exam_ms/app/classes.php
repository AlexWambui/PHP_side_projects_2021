<?php
include_once "include/functions.php";
protect_page();
admin_page();
if (isset($_POST['add_class'])) add_class();
if (isset($_POST['delete_class'])) delete_class();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Classes</title>
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
                        <h5>Classes</h5>
                    </div>
                    <div class="col text-right">
                        <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold">New Class</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <form action="./classes.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="form-group">
                                                <label for="class_name">Class Name</label>
                                                <input type="text" name="class_name" id="class_name"
                                                       class="form-control validate" placeholder="Class Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_teacher_id">Class Teacher</label>
                                                <select name="class_teacher_id" id="class_teacher_id" class="selectpicker form-control"
                                                        data-live-search="true" required>
                                                    <option data-tokens="none_selected">Select Teacher</option>
                                                    <?= select_users_options() ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" name="add_class" id="add_class"
                                                class="btn btn-default">Save
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                           data-target="#modalAddPayment">New</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover" id="data_table">
                    <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Class Teacher</th>
                        <?php if ($_SESSION['user_level'] == 3): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all_classes() as $class)
                    {
                        ?>
                        <tr>
                            <td><?= $class['class_name'] ?></td>
                            <td><?= $class['first_name'].' '.$class['last_name'] ?></td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <?php if ($_SESSION['user_level'] == 3): ?>
                                        <div class="action_buttons">
                                            <form action="update_class.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $class['class_id']; ?>">
                                                <button class="btn btn-success btn-sm " type="submit"
                                                        name="edit_class"><span
                                                        class="icon-pencil"></span> Edit
                                                </button>
                                            </form>
                                        </div>
                                        <div class="action_buttons">
                                            <form action="./classes.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $class['class_id']; ?>">
                                                <button class="btn btn-danger btn-sm " type="submit"
                                                        name="delete_class"><span
                                                        class="icon-trash"></span> Delete
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
