<?php
include_once "include/functions.php";
protect_page();
admin_page();
if (isset($_POST['add_subject'])) add_subject();
if (isset($_POST['delete_subject'])) delete_subject();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Subjects</title>
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
                        <h5><?= count_all('subjects') ?> Subjects</h5>
                    </div>
                    <div class="col text-right">
                        <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold">New Subject</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <form action="./subjects.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="form-group">
                                                <label for="subject_name">Subject Name</label>
                                                <input type="text" name="subject_name" id="subject_name"
                                                       class="form-control validate" placeholder="Subject Name" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" name="add_subject" id="add_subject"
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
                        <th>Subject Name</th>
                        <?php if ($_SESSION['user_level'] == 3): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (fetch_all('subjects') as $subject)
                    {
                        ?>
                        <tr>
                            <td><?= $subject['subject_name'] ?></td>
                            <td>
                                <div class="action_buttons_wrapper">
                                    <?php if ($_SESSION['user_level'] == 3): ?>
                                        <div class="action_buttons">
                                            <form action="update_subject.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $subject['subject_id']; ?>">
                                                <button class="btn btn-success btn-sm " type="submit"
                                                        name="edit_subject"><span
                                                        class="icon-pencil"></span> Edit
                                                </button>
                                            </form>
                                        </div>
                                        <div class="action_buttons">
                                            <form action="./subjects.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $subject['subject_id']; ?>">
                                                <button class="btn btn-danger btn-sm " type="submit"
                                                        name="delete_subject"><span
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
