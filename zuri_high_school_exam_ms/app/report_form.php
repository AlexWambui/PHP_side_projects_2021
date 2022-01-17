<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Document</title>
</head>
<body onload="window.print()">
<main class="report_form">
    <div class="container">
        <?php foreach(fetch_this_results() as $marks) ?>
        <div class="report_form_header">
            <h3 class="text-center">ZURI HIGH SCHOOL</h3>
            <p class="text-center">P.O Box 321-43009 KIAMBU, KENYA</p>
            <p class="text-center">Tel: 0746 055 487 / 0745 342 222</p>
            <p class="text-center"><b>ACADEMIC REPORT FOR TERM <?= $marks['term'].' '.$marks['year'] ?></b></p>
            <div class="row">
                <div class="col">
                    <p>Student Name: <?= $marks['first_name'].' '.$marks['last_name'] ?></p>
                </div>
                <div class="col">
                    <p>Admission Number: <?= $marks['adm_number'] ?></p>
                </div>
            </div>
            <div class="report_form_body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>CAT 1 (%)</th>
                        <th>CAT 2 (%)</th>
                        <th>End Term (%)</th>
                        <th>Total (100 %)</th>
                        <th>GRADE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Maths</td>
                        <td><?= $marks['cat1_maths'] ?></td>
                        <td><?= $marks['cat2_maths'] ?></td>
                        <td><?= $marks['end_term_maths'] ?></td>
                        <?php $maths = round(($marks['cat1_maths'] + $marks['cat2_maths'] + $marks['end_term_maths']) / 3, 2)  ?>
                        <td><?= $maths ?></td>
                        <td><?php grade($maths) ?></td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td><?= $marks['cat1_english'] ?></td>
                        <td><?= $marks['cat2_english'] ?></td>
                        <td><?= $marks['end_term_english'] ?></td>
                        <?php $english = round(($marks['cat1_english'] + $marks['cat2_english'] + $marks['end_term_english']) / 3, 2)  ?>
                        <td><?= $english ?></td>
                        <td><?php grade($english) ?></td>
                    </tr>
                    <tr>
                        <td>Kiswahili</td>
                        <td><?= $marks['cat1_kiswahili'] ?></td>
                        <td><?= $marks['cat2_kiswahili'] ?></td>
                        <td><?= $marks['end_term_kiswahili'] ?></td>
                        <?php $kiswahili = round(($marks['cat1_kiswahili'] + $marks['cat2_kiswahili'] + $marks['end_term_kiswahili']) / 3, 2)  ?>
                        <td><?= $kiswahili ?></td>
                        <td><?php grade($kiswahili) ?></td>
                    </tr>
                    <tr>
                        <td>Physics</td>
                        <td><?= $marks['cat1_physics'] ?></td>
                        <td><?= $marks['cat2_physics'] ?></td>
                        <td><?= $marks['end_term_physics'] ?></td>
                        <?php $physics = round(($marks['cat1_physics'] + $marks['cat2_physics'] + $marks['end_term_physics']) / 3, 2)  ?>
                        <td><?= $physics ?></td>
                        <td><?php grade($physics) ?></td>
                    </tr>
                    <tr>
                        <td>Biology</td>
                        <td><?= $marks['cat1_biology'] ?></td>
                        <td><?= $marks['cat2_biology'] ?></td>
                        <td><?= $marks['end_term_biology'] ?></td>
                        <?php $biology = round(($marks['cat1_biology'] + $marks['cat2_biology'] + $marks['end_term_biology']) / 3, 2)  ?>
                        <td><?= $biology ?></td>
                        <td><?php grade($biology) ?></td>
                    </tr>
                    <tr>
                        <td>Chemistry</td>
                        <td><?= $marks['cat1_chemistry'] ?></td>
                        <td><?= $marks['cat2_chemistry'] ?></td>
                        <td><?= $marks['end_term_chemistry'] ?></td>
                        <?php $chemistry = round(($marks['cat1_chemistry'] + $marks['cat2_chemistry'] + $marks['end_term_chemistry']) / 3, 2)  ?>
                        <td><?= $chemistry ?></td>
                        <td><?php grade($chemistry) ?></td>
                    </tr>
                    <tr>
                        <td>Geography</td>
                        <td><?= $marks['cat1_geography'] ?></td>
                        <td><?= $marks['cat2_geography'] ?></td>
                        <td><?= $marks['end_term_geography'] ?></td>
                        <?php $geography = round(($marks['cat1_geography'] + $marks['cat2_geography'] + $marks['end_term_geography']) / 3, 2)  ?>
                        <td><?= $geography ?></td>
                        <td><?php grade($geography) ?></td>
                    </tr>
                    <tr>
                        <td>History</td>
                        <td><?= $marks['cat1_history'] ?></td>
                        <td><?= $marks['cat2_history'] ?></td>
                        <td><?= $marks['end_term_history'] ?></td>
                        <?php $history = round(($marks['cat1_history'] + $marks['cat2_history'] + $marks['end_term_history']) / 3, 2)  ?>
                        <td><?= $history ?></td>
                        <td><?php grade($history) ?></td>
                    </tr>
                    <tr>
                        <td>Agriculture</td>
                        <td><?= $marks['cat1_agriculture'] ?></td>
                        <td><?= $marks['cat2_agriculture'] ?></td>
                        <td><?= $marks['end_term_agriculture'] ?></td>
                        <?php $agriculture = round(($marks['cat1_agriculture'] + $marks['cat2_agriculture'] + $marks['end_term_agriculture']) / 3, 2)  ?>
                        <td><?= $agriculture ?></td>
                        <td><?php grade($agriculture) ?></td>
                    </tr>
                    <tr>
                        <td>Business Studies</td>
                        <td><?= $marks['cat1_business_studies'] ?></td>
                        <td><?= $marks['cat2_business_studies'] ?></td>
                        <td><?= $marks['end_term_business_studies'] ?></td>
                        <?php $business_studies = round(($marks['cat1_business_studies'] + $marks['cat2_business_studies'] + $marks['end_term_business_studies']) / 3, 2)  ?>
                        <td><?= $business_studies ?></td>
                        <td><?php grade($business_studies) ?></td>
                    </tr>
                    <tr>
                        <td>CRE</td>
                        <td><?= $marks['cat1_cre'] ?></td>
                        <td><?= $marks['cat2_cre'] ?></td>
                        <td><?= $marks['end_term_cre'] ?></td>
                        <?php $cre = round(($marks['cat1_cre'] + $marks['cat2_cre'] + $marks['end_term_cre']) / 3, 2)  ?>
                        <td><?= $cre ?></td>
                        <td><?php grade($cre) ?></td>
                    </tr>
                    <tr>
                        <td>Computer Studies</td>
                        <td><?= $marks['cat1_computer_studies'] ?></td>
                        <td><?= $marks['cat2_computer_studies'] ?></td>
                        <td><?= $marks['end_term_computer_studies'] ?></td>
                        <?php $computer_studies = round(($marks['cat1_computer_studies'] + $marks['cat2_computer_studies'] + $marks['end_term_computer_studies']) / 3, 2)  ?>
                        <td><?= $computer_studies ?></td>
                        <td><?php grade($computer_studies) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="extra_information">
                <div class="row justify-content-center">
                    <div class="col">
                        <p class="text-center">Overall Grade:
                            <?php
                            $overall = round(($maths + $english + $kiswahili + $physics + $biology + $chemistry + $geography + $history + $agriculture + $business_studies + $cre + $computer_studies) / 12, 2);
                            echo $overall.' ';
                            echo grade($overall);
                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="report_form_footer">
            <p>Remarks: <?php if($overall < 50) echo 'below average'; else echo 'good keep it up'; ?></p>
            <p>Date: <?= date('d-m-Y') ?></p>
            <h5>Grading System</h5>
            <div class="row grading_system">
                <div class="col">
                    <p>95 - 100 - A</p>
                    <p>90 - 94 - A-</p>
                </div>
                <div class="col">
                    <p>80 - 89 - B+</p>
                    <p>70 - 79 - B</p>
                </div>
                <div class="col">
                    <p>60 - 69 - B-</p>
                    <p>50 - 59 - C+</p>
                </div>
                <div class="col">
                    <p>40 - 49 - C</p>
                    <p>30 - 39 - C-</p>
                </div>
                <div class="col">
                    <p>26 - 29 - D+</p>
                    <p>20 - 25 - D</p>
                </div>
                <div class="col">
                    <p>10 - 19 - D-</p>
                    <p>0 - 9 - E</p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>