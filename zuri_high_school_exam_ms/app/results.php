<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Results</title>
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
                        <h5>Results</h5>
                    </div>
                    <div class="col text-right">
                        <a href="add_results.php" class="btn btn-success btn-rounded text-right">New</a>
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all_results() as $marks) {
                        ?>
                        <tr>
                            <td><?= $marks['first_name'] . ' ' . $marks['last_name'] ?></td>
                            <td><?= $marks['adm_number'] ?></td>
                            <td><?= $marks['class_name'] ?></td>
                            <td><?= $marks['term'] ?></td>
                            <td><?= $marks['year'] ?></td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <div class="action_buttons">
                                        <form action="update_results.php" method="post">
                                            <input type="hidden" name="update_id"
                                                   value="<?= $marks['results_id']; ?>">
                                            <button class="btn btn-success btn-sm " type="submit"
                                                    name="edit_marks"><span
                                                        class="icon-pencil"></span> Edit
                                            </button>
                                        </form>
                                    </div>
                                    <div class="action_buttons">
                                        <form action="./report_form.php" method="post">
                                            <input type="hidden" name="update_id"
                                                   value="<?= $marks['results_id']; ?>">
                                            <button class="btn btn-info btn-sm" type="submit" name="report_form"
                                                    class="icon-print"> Report
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
