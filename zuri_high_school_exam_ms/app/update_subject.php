<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_subject_btn'])) update_subject();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Subject</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <?php foreach (fetch_this_subject() as $subject): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Update Class</h5>
                    </div>
                    <div class="card-body">
                        <form action="./update_subject.php" method="post" autocomplete="off">
                            <input type="hidden" name="update_id" value="<?= $subject['subject_id'] ?>">
                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" name="subject_name" id="subject_name"
                                       class="form-control validate" placeholder="Subject Name"
                                       value="<?= $subject['subject_name'] ?>" required>
                            </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_subject_btn" id="update_subject_btn"
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
