<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_student_btn'])) update_student();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Student</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <?php foreach (fetch_this_student() as $student): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Update Student</h5>
                </div>
                <div class="card-body">
                    <form action="./update_student.php" method="post" autocomplete="off">
                        <input type="hidden" name="update_id" value="<?= $student['student_id'] ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?= $student['first_name'] ?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?= $student['last_name'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="admission_number">Admission Number</label>
                            <input type="text" name="admission_number" id="admission_number" class="form-control" placeholder="Admission Number" value="<?= $student['adm_number'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="class_id">class</label>
                            <select name="class_id" id="class_id" class="selectpicker form-control"
                                    data-live-search="true" required>
                                <option value="<?= $student['class_id'] ?>"><?= $student['class_name'] ?></option>
                                <?= select_class_options() ?>
                            </select>
                        </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="update_student_btn" id="update_student_btn"
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
