<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_marks_btn'])) update_marks();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Marks</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <?php foreach (fetch_this_marks() as $marks): ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Update Marks</h5>
                        </div>
                        <div class="card-body">
                            <form action="./update_marks.php" method="post" autocomplete="off">
                                <input type="hidden" name="update_id" value="<?= $marks['marks_id'] ?>">
                                <div class="form-group">
                                    <label for="student_id">Student Names</label>
                                    <select name="student_id" id="student_id" class="selectpicker form-control"
                                            data-live-search="true" required>
                                        <option value="<?= $marks['student_id'] ?>"><?= $marks['first_name'].' '.$marks['last_name'] ?></option>
                                        <?= select_student_options() ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="maths">Maths</label>
                                            <input type="number" name="maths" id="maths" class="form-control" value="<?= $marks['maths'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="english">English</label>
                                            <input type="number" name="english" id="english" class="form-control" value="<?= $marks['english'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="kiswahili">Kiswahili</label>
                                            <input type="number" name="kiswahili" id="kiswahili" class="form-control" value="<?= $marks['kiswahili'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="physics">Physics</label>
                                            <input type="number" name="physics" id="physics" class="form-control" value="<?= $marks['physics'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="chemistry">Chemistry</label>
                                            <input type="number" name="chemistry" id="chemistry" class="form-control" value="<?= $marks['chemistry'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="biology">Biology</label>
                                            <input type="number" name="biology" id="biology" class="form-control" value="<?= $marks['biology'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="geography">Geography</label>
                                            <input type="number" name="geography" id="geography" class="form-control" value="<?= $marks['geography'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="history">History</label>
                                            <input type="number" name="history" id="history" class="form-control" value="<?= $marks['history'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cre">CRE</label>
                                            <input type="number" name="cre" id="cre" class="form-control" value="<?= $marks['cre'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="agriculture">Agriculture</label>
                                            <input type="number" name="agriculture" id="agriculture" class="form-control" value="<?= $marks['agriculture'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="business_studies">Business Studies</label>
                                            <input type="number" name="business_studies" id="business_studies" class="form-control" value="<?= $marks['business_studies'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="computer_studies">Computer Studies</label>
                                            <input type="number" name="computer_studies" id="computer_studies" class="form-control" value="<?= $marks['computer_studies'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exam_type">Exam Type</label>
                                            <select name="exam_type" id="exam_type" class="form-control" required>
                                                <option value="<?= $marks['exam_type'] ?>"><?= $marks['exam_type'] ?></option>
                                                <option value="cat_1">CAT 1</option>
                                                <option value="cat_2">CAT 2</option>
                                                <option value="end_term">End Term</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <input type="number" name="year" id="year" class="form-control" required value="<?= $marks['year'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="term">Term</label>
                                            <select name="term" id="term" class="form-control" required>
                                                <option value="<?= $marks['term'] ?>"><?= $marks['term'] ?></option>
                                                <option value="1">Term I</option>
                                                <option value="2">Term II</option>
                                                <option value="3">Term III</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" name="remarks" id="remarks" class="form-control" <?= $marks['remarks'] ?>>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="update_marks_btn" id="update_marks_btn"
                                            class="btn btn-success">Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
