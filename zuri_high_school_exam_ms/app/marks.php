<?php
include_once "include/functions.php";
protect_page();
admin_page();
if (isset($_POST['add_marks'])) add_marks();
if (isset($_POST['delete_marks'])) delete_marks();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Marks</title>
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
                        <h5><?= count_all('marks') ?> Marks</h5>
                    </div>
                    <div class="col text-right">
                        <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold">Enter Marks</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <form action="./marks.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="form-group">
                                                <label for="student_id">Student Names</label>
                                                <select name="student_id" id="student_id" class="selectpicker form-control"
                                                        data-live-search="true" required>
                                                    <option data-tokens="none_selected">Select Student</option>
                                                    <?= select_student_options() ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="maths">Maths</label>
                                                        <input type="number" name="maths" id="maths" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="english">English</label>
                                                        <input type="number" name="english" id="english" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="kiswahili">Kiswahili</label>
                                                        <input type="number" name="kiswahili" id="kiswahili" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="physics">Physics</label>
                                                        <input type="number" name="physics" id="physics" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="chemistry">Chemistry</label>
                                                        <input type="number" name="chemistry" id="chemistry" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="biology">Biology</label>
                                                        <input type="number" name="biology" id="biology" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="geography">Geography</label>
                                                        <input type="number" name="geography" id="geography" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="history">History</label>
                                                        <input type="number" name="history" id="history" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="cre">CRE</label>
                                                        <input type="number" name="cre" id="cre" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="agriculture">Agriculture</label>
                                                        <input type="number" name="agriculture" id="agriculture" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="business_studies">Business Studies</label>
                                                        <input type="number" name="business_studies" id="business_studies" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="computer_studies">Computer Studies</label>
                                                        <input type="number" name="computer_studies" id="computer_studies" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exam_type">Exam Type</label>
                                                        <select name="exam_type" id="exam_type" class="form-control" required>
                                                            <option value="none_selected">Select Exam Type</option>
                                                            <option value="cat_1">CAT 1</option>
                                                            <option value="cat_2">CAT 2</option>
                                                            <option value="end_term">End Term</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="year">Year</label>
                                                        <input type="number" name="year" id="year" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="term">Term</label>
                                                        <select name="term" id="term" class="form-control" required>
                                                            <option value="none_selected">Term</option>
                                                            <option value="1">Term I</option>
                                                            <option value="2">Term II</option>
                                                            <option value="3">Term III</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <input type="text" name="remarks" id="remarks" class="form-control">
                                            </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" name="add_marks" id="add_marks"
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
                        <th>Term</th>
                        <th>Year</th>
                        <th>Exam Type</th>
                        <?php if ($_SESSION['user_level'] == 3): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all_marks() as $marks)
                    {
                        ?>
                        <tr>
                            <td><?= $marks['first_name'].' '.$marks['last_name'] ?></td>
                            <td><?= $marks['adm_number'] ?></td>
                            <td><?= $marks['class_name'] ?></td>
                            <td><?= $marks['term'] ?></td>
                            <td><?= $marks['year'] ?></td>
                            <td><?= $marks['exam_type'] ?></td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <?php if ($_SESSION['user_level'] == 3): ?>
                                        <div class="action_buttons">
                                            <form action="update_marks.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $marks['marks_id']; ?>">
                                                <button class="btn btn-success btn-sm " type="submit"
                                                        name="edit_marks"><span
                                                        class="icon-pencil"></span> Edit
                                                </button>
                                            </form>
                                        </div>
                                        <div class="action_buttons">
                                            <form action="./report_form.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $marks['marks_id']; ?>">
                                                <button class="btn btn-info btn-sm" type="submit" name="report_form" class="icon-print"> Report</button>
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
