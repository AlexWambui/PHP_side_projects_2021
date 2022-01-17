<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['save_results'])) add_results();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Add Result</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card results_card">
                    <div class="card-header">
                        <h5 class="text-center">Add Results</h5>
                    </div>
                    <div class="card-body">
                        <form action="./add_results.php" method="post" >
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="student_id">Student Names</label>
                                        <select name="student_id" id="student_id"
                                                class="selectpicker form-control"
                                                data-live-search="true" required>
                                            <option data-tokens="none_selected">Select Student</option>
                                            <?= select_student_options() ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" name="year" id="year" class="form-control"
                                               required>
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
                                        <input type="number" class="form-control-sm" name="cat1_maths">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_english">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_kiswahili">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_physics">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_biology">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_chemistry">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_geography">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_history">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_agriculture">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_business_studies">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_cre">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat1_computer_studies">
                                    </div>
                                </div>
                                <div class="col">
                                    <p>CAT 2 (%)</p>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_maths">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_english">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_kiswahili">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_physics">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_biology">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_chemistry">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_geography">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_history">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_agriculture">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_business_studies">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_cre">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="cat2_computer_studies">
                                    </div>
                                </div>
                                <div class="col">
                                    <p>End Term (%)</p>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_maths">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_english">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_kiswahili">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_physics">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_biology">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_chemistry">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_geography">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_history">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_agriculture">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_business_studies">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_cre">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control-sm" name="end_term_computer_studies">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group text-center">
                                <button class="btn btn-success" name="save_results">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>