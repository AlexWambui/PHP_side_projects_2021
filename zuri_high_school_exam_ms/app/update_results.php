<?php
include_once "../app/include/functions.php";
protect_page();
if (isset($_POST['update_results_btn'])) update_results();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Results</title>
</head>
<body>
<?php include_once "../app/include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <?php foreach (fetch_this_results() as $results): ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Update Results</h5>
                        </div>
                        <div class="card-body">
                            <form action="./update_results.php" method="post" autocomplete="off">
                                <input type="hidden" name="update_id" value="<?= $results['results_id'] ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="student_id">Student Names</label>
                                            <select name="student_id" id="student_id"
                                                    class="selectpicker form-control"
                                                    data-live-search="true" required>
                                                <option value="<?= $results['student_id'] ?>"><?= $results['first_name'].' '.$results['last_name'] ?></option>
                                                <?= select_student_options() ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <input type="number" name="year" id="year" class="form-control" value="<?= $results['year'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="term">Term</label>
                                            <select name="term" id="term" class="form-control" required>
                                                <option value="<?= $results['term'] ?>"><?= $results['term'] ?></option>
                                                <option value="1">Term I</option>
                                                <option value="2">Term II</option>
                                                <option value="3">Term III</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row subjects">
                                    <div class="col">
                                        <p class="text-right">Subject</p>
                                        <div class="form-group">
                                            <p>Maths</p>
                                        </div>
                                        <div class="form-group">
                                            <p>English</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Kiswahili</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Physics</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Biology</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Chemistry</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Geography</p>
                                        </div>
                                        <div class="form-group">
                                            <p>History</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Agriculture</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Business Studies</p>
                                        </div>
                                        <div class="form-group">
                                            <p>CRE</p>
                                        </div>
                                        <div class="form-group">
                                            <p>Computer Studies</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p>CAT 1 (%)</p>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_maths" value="<?= $results['cat1_maths'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_english" value="<?= $results['cat1_english'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_kiswahili" value="<?= $results['cat1_kiswahili'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_physics" value="<?= $results['cat1_physics'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_biology" value="<?= $results['cat1_biology'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_chemistry" value="<?= $results['cat1_chemistry'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_geography" value="<?= $results['cat1_geography'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_history" value="<?= $results['cat1_history'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_agriculture" value="<?= $results['cat1_agriculture'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_business_studies" value="<?= $results['cat1_business_studies'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_cre" value="<?= $results['cat1_cre'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat1_computer_studies" value="<?= $results['cat1_computer_studies'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p>CAT 2 (%)</p>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_maths" value="<?= $results['cat2_maths'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_english" value="<?= $results['cat2_english'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_kiswahili" value="<?= $results['cat2_kiswahili'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_physics" value="<?= $results['cat2_physics'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_biology" value="<?= $results['cat2_biology'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_chemistry" value="<?= $results['cat2_chemistry'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_geography" value="<?= $results['cat2_geography'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_history" value="<?= $results['cat2_history'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_agriculture" value="<?= $results['cat2_agriculture'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_business_studies" value="<?= $results['cat2_business_studies'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_cre" value="<?= $results['cat2_cre'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="cat2_computer_studies" value="<?= $results['cat2_computer_studies'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p>End Term (%)</p>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_maths" value="<?= $results['end_term_maths'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_english" value="<?= $results['end_term_english'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_kiswahili" value="<?= $results['end_term_kiswahili'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_physics" value="<?= $results['end_term_physics'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_biology" value="<?= $results['end_term_biology'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_chemistry" value="<?= $results['end_term_chemistry'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_geography" value="<?= $results['end_term_geography'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_history" value="<?= $results['end_term_history'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_agriculture" value="<?= $results['end_term_agriculture'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_business_studies" value="<?= $results['end_term_business_studies'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_cre" value="<?= $results['end_term_cre'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control-sm" name="end_term_computer_studies" value="<?= $results['end_term_computer_studies'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    <button type="submit" name="update_results_btn" id="update_results_btn"
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
