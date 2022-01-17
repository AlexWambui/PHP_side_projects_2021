<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_class_btn'])) update_class();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Class</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <?php foreach (fetch_this_class() as $class): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Class</h5>
                    </div>
                    <div class="card-body">
                        <form action="./update_class.php" method="post" autocomplete="off">
                            <input type="hidden" name="update_id" value="<?= $class['class_id'] ?>">
                            <div class="form-group">
                                <label for="class_name">Class Name</label>
                                <input type="text" name="class_name" id="class_name" class="form-control"
                                       placeholder="Class Name" value="<?= $class['class_name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="class_teacher_id">Class Teacher</label>
                                <select name="class_teacher_id" id="class_teacher_id" class="selectpicker form-control"
                                        data-live-search="true" required>
                                    <option value="<?= $class['class_id'] ?>"><?= $class['first_name'].' '.$class['last_name'] ?></option>
                                    <?= select_users_options() ?>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_class_btn" id="update_class_btn"
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
