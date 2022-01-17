<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_student'])) add_student();
if (isset($_POST['delete_student'])) delete_student();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Students</title>
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
                        <h5>Students</h5>
                    </div>
                    <div class="col text-right">
                        <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold">New Student</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <form action="./students.php" method="post" enctype="multipart/form-data"
                                              autocomplete="off">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" name="first_name" id="first_name"
                                                               class="form-control" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" name="last_name" id="last_name"
                                                               class="form-control" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="admission_number">Admission Number</label>
                                                <input type="text" name="admission_number" id="admission_number"
                                                       class="form-control" placeholder="Admission Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_id">class</label>
                                                <select name="class_id" id="class_id" class="selectpicker form-control"
                                                        data-live-search="true" required>
                                                    <option data-tokens="none_selected">Select Class</option>
                                                    <?= select_class_options() ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" name="add_student" id="add_student"
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
                <table class="table table-hover table-bordered" id="data_table">
                    <thead>
                    <tr>
                        <th>Student Names</th>
                        <th>Admission Number</th>
                        <th>Class</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all_students() as $student) {
                        ?>
                        <tr>
                            <td><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>
                            <td><?= $student['adm_number'] ?></td>
                            <td><?= $student['class_name'] ?></td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <div class="action_buttons">
                                        <form action="update_student.php" method="post">
                                            <input type="hidden" name="update_id"
                                                   value="<?= $student['student_id']; ?>">
                                            <button class="btn btn-success btn-sm " type="submit"
                                                    name="edit_student"><span
                                                        class="icon-pencil"></span> Edit
                                            </button>
                                        </form>
                                    </div>
                                    <div class="action_buttons">
                                        <form action="./students.php" method="post">
                                            <input type="hidden" name="delete_id"
                                                   value="<?= $student['student_id']; ?>">
                                            <button class="btn btn-danger btn-sm " type="submit"
                                                    name="delete_student"><span
                                                        class="icon-trash"></span> Delete
                                            </button>
                                        </form>
                                    </div>
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
