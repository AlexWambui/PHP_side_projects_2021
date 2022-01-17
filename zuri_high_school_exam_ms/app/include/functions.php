<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_zuri_high_school";
$db_connection = mysqli_connect($hostname, $username, $password, $database)
or die("<b>Connection to the server couldn't be established. Try starting mysql on Xampp or contact the developer for help!</b>");

function protect_page()
{
    session_start();
    if (!isset($_SESSION['id'])) header("location: ../index.php");
}
function admin_page()
{
    if ($_SESSION['user_level'] == 1) header('location: welcome_page.php');
}
function alert()
{
    if (isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oooops!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_COOKIE['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?= $_COOKIE['success'] ?>
    </div>
<?php endif;
}

function signup_user()
{
    global $db_connection;
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `email_address`, `phone_number`, `password`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "sssss", $first_name, $last_name, $email, $phone, $password);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    setcookie("success", "Registered successfully!", time() + 2);
    header('location: login.php');
}
function login()
{
    global $db_connection;

    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    $sql_fetch_users = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ? LIMIT 1");
    mysqli_stmt_bind_param($sql_fetch_users, "s", $email);
    mysqli_stmt_execute($sql_fetch_users);
    $fetched_users = mysqli_stmt_get_result($sql_fetch_users);

    //if email is found
    if (mysqli_num_rows($fetched_users) == 1) {
        $user = mysqli_fetch_assoc($fetched_users);
        if ($user['password'] == $password) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email_address'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_level'] = $user['user_level'];
            header('location: welcome_page.php');
        } else {
            setcookie("error", "Wrong Credentials!", time() + 2);
            header('location: ./login.php');
        }
    } else {
        setcookie("error", "Wrong Credentials!", time() + 2);
        header('location: ./login.php');
    }
}
function greet_user(): string
{
    return 'Hi ' . $_SESSION['first_name'];
}

function fetch_all($table_name): mysqli_result|bool
{
    global $db_connection;
    $sql_fetch_all = $db_connection->query("SELECT * FROM $table_name") or die(mysqli_error($db_connection));
    return $sql_fetch_all;
}
function fetch_user_session($table_name): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['id'];
    $sql_fetch_where = $db_connection->query("SELECT * FROM $table_name WHERE id = '$id' ") or die(mysqli_error($db_connection));
    return $sql_fetch_where;
}
function count_all($table_name): int
{
    return mysqli_num_rows(fetch_all($table_name));
}
function fetch_this_row($table_name): mysqli_result|bool
{
    global $db_connection;
    $update_id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT * FROM $table_name WHERE id = '$update_id' ");
}
function delete($table_name)
{
    global $db_connection;
    $delete_id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM $table_name WHERE id = '$delete_id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
}

function update_user_level()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $user_level = $_REQUEST['user_level'];

    $sql = mysqli_prepare($db_connection, "UPDATE users SET `user_level` = '$user_level' WHERE id = '$id' ");
    mysqli_stmt_execute($sql) or die(mysqli_stmt_error($sql));
    setcookie('success', 'user updated successfully', time() + 3);
    header('location: users.php');
}
function update_user_status($status)
{
    global $db_connection;

    $id = $_REQUEST['update_id'];

    $sql = mysqli_prepare($db_connection, "UPDATE users SET `status` = '$status' WHERE id = '$id' ");
    mysqli_stmt_execute($sql) or die(mysqli_stmt_error($sql));
    setcookie('success', 'user updated successfully', time() + 3);
    header('location: users.php');
}
function fetch_user_status($status): mysqli_result|bool
{
    global $db_connection;

    $sql = $db_connection->query("SELECT * FROM users WHERE status = '$status' ") or die(mysqli_error($db_connection));
    return $sql;
}
function count_user_status($status): int
{
    return mysqli_num_rows(fetch_user_status($status));
}
function select_users_options(): string
{
    $output = '';
    foreach (fetch_all('users') as $user) {
        $output .= '<option value="'.$user["id"].'">'.$user["first_name"].' '.$user['last_name'].'</option>';
    }
    return $output;
}

function add_class()
{
    global $db_connection;

    $class_name = $_REQUEST['class_name'];
    $class_teacher = $_REQUEST['class_teacher_id'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO classes (`class_name`, `class_teacher_id`) VALUES (?,?)");
    mysqli_stmt_bind_param($sql_add, "si",$class_name, $class_teacher);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie('success', 'Class has been added 😉.', time() + 2);
    header("location: ./classes.php");
}
function update_class()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $class_name = $_REQUEST['class_name'];
    $class_teacher = $_REQUEST['class_teacher_id'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE classes SET `class_name` = '$class_name', `class_teacher_id` = '$class_teacher' WHERE class_id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie("success", "Class updated!", time() + 2);
    header('location: classes.php');
}
function delete_class()
{
    global $db_connection;

    $id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM classes WHERE class_id = '$id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
    setcookie("success", "class has been deleted 😮.", time() + 2);
    header('location: ./classes.php');
}
function fetch_all_classes(): mysqli_result|bool
{
    global $db_connection;

    return $db_connection->query("SELECT * FROM classes JOIN users ON classes.class_teacher_id = users.id  ");
}
function fetch_this_class(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT * FROM classes JOIN users ON classes.class_teacher_id = users.id  ");
}
function select_class_options(): string
{
    $output = '';
    foreach (fetch_all('classes') as $class) {
        $output .= '<option value="'.$class["class_id"].'">'.$class["class_name"].'</option>';
    }
    return $output;
}

function add_subject()
{
    global $db_connection;

    $subject_name = $_REQUEST['subject_name'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO subjects (`subject_name`) VALUES (?)");
    mysqli_stmt_bind_param($sql_add, "s",$subject_name);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie('success', 'Subject has been added 😉.', time() + 2);
    header("location: ./subjects.php");
}
function update_subject()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $subject_name = $_REQUEST['subject_name'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE subjects SET `subject_name` = '$subject_name' WHERE subject_id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie("success", "subject has been updated!", time() + 2);
    header('location: subjects.php');
}
function delete_subject()
{
    global $db_connection;

    $id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM subjects WHERE subject_id = '$id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
    setcookie("success", "subject has been deleted 😮.", time() + 2);
    header('location: ./subjects.php');
}
function fetch_this_subject(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT * FROM subjects WHERE subject_id = '$id'  ");
}

function add_student()
{
    global $db_connection;

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $adm_number = $_REQUEST['admission_number'];
    $class_id = $_REQUEST['class_id'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO students (`first_name`, `last_name`, `adm_number`, `class_id`) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_add, "sssi",$first_name, $last_name, $adm_number, $class_id);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie('success', 'Student has been added 😉.', time() + 2);
    header("location: ./students.php");
}
function update_student()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $adm_number = $_REQUEST['admission_number'];
    $class_id = $_REQUEST['class_id'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE students SET `first_name` = '$first_name', `last_name` = '$last_name', `adm_number` = '$adm_number', `class_id` = '$class_id' WHERE student_id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie("success", "student has been updated!", time() + 2);
    header('location: students.php');
}
function delete_student()
{
    global $db_connection;

    $id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM students WHERE student_id = '$id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
    setcookie("success", "student has been deleted 😮.", time() + 2);
    header('location: ./students.php');
}
function fetch_this_student(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT * FROM students JOIN classes ON classes.class_id = students.class_id WHERE student_id = '$id'  ");
}
function fetch_all_students(): mysqli_result|bool
{
    global $db_connection;

    $sql = $db_connection->query("SELECT * FROM students JOIN classes ON students.class_id = classes.class_id ") or die(mysqli_error($db_connection));
    return $sql;
}
function select_student_options(): string
{
    $output = '';
    foreach (fetch_all_students() as $student) {
        $output .= '<option value="'.$student["student_id"].'">'.$student["first_name"].' '.$student['last_name'].'</option>';
    }
    return $output;
}

function add_results()
{
    global $db_connection;

    $student_id = $_REQUEST['student_id'];
    $year = $_REQUEST['year'];
    $term = $_REQUEST['term'];
    $cat1_maths = $_REQUEST['cat1_maths'];
    $cat1_english = $_REQUEST['cat1_english'];
    $cat1_kiswahili = $_REQUEST['cat1_kiswahili'];
    $cat1_physics = $_REQUEST['cat1_physics'];
    $cat1_biology = $_REQUEST['cat1_biology'];
    $cat1_chemistry = $_REQUEST['cat1_chemistry'];
    $cat1_geography = $_REQUEST['cat1_geography'];
    $cat1_history = $_REQUEST['cat1_history'];
    $cat1_agriculture = $_REQUEST['cat1_agriculture'];
    $cat1_business_studies = $_REQUEST['cat1_business_studies'];
    $cat1_cre = $_REQUEST['cat1_cre'];
    $cat1_computer_studies = $_REQUEST['cat1_computer_studies'];
    $cat2_maths = $_REQUEST['cat2_maths'];
    $cat2_english = $_REQUEST['cat2_english'];
    $cat2_kiswahili = $_REQUEST['cat2_kiswahili'];
    $cat2_physics = $_REQUEST['cat2_physics'];
    $cat2_biology = $_REQUEST['cat2_biology'];
    $cat2_chemistry = $_REQUEST['cat2_chemistry'];
    $cat2_geography = $_REQUEST['cat2_geography'];
    $cat2_history = $_REQUEST['cat2_history'];
    $cat2_agriculture = $_REQUEST['cat2_agriculture'];
    $cat2_business_studies = $_REQUEST['cat2_business_studies'];
    $cat2_cre = $_REQUEST['cat2_cre'];
    $cat2_computer_studies = $_REQUEST['cat2_computer_studies'];
    $end_term_maths = $_REQUEST['end_term_maths'];
    $end_term_english = $_REQUEST['end_term_english'];
    $end_term_kiswahili = $_REQUEST['end_term_kiswahili'];
    $end_term_physics = $_REQUEST['end_term_physics'];
    $end_term_biology = $_REQUEST['end_term_biology'];
    $end_term_chemistry = $_REQUEST['end_term_chemistry'];
    $end_term_geography = $_REQUEST['end_term_geography'];
    $end_term_history = $_REQUEST['end_term_history'];
    $end_term_agriculture = $_REQUEST['end_term_agriculture'];
    $end_term_business_studies = $_REQUEST['end_term_business_studies'];
    $end_term_cre = $_REQUEST['end_term_cre'];
    $end_term_computer_studies = $_REQUEST['end_term_computer_studies'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO results (`student_id`, `year`, `term`, `cat1_maths`, `cat1_english`, `cat1_kiswahili`, `cat1_physics`, `cat1_biology`, `cat1_chemistry`, `cat1_geography`, `cat1_history`, `cat1_agriculture`, `cat1_business_studies`, `cat1_cre`, `cat1_computer_studies`, `cat2_maths`, `cat2_english`, `cat2_kiswahili`, `cat2_physics`, `cat2_biology`, `cat2_chemistry`, `cat2_geography`, `cat2_history`, `cat2_agriculture`, `cat2_business_studies`, `cat2_cre`, `cat2_computer_studies`, `end_term_maths`, `end_term_english`, `end_term_kiswahili`, `end_term_physics`, `end_term_biology`, `end_term_chemistry`, `end_term_geography`, `end_term_history`, `end_term_agriculture`, `end_term_business_studies`, `end_term_cre`, `end_term_computer_studies`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_add, "iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii",$student_id, $year, $term, $cat1_maths, $cat1_english, $cat1_kiswahili, $cat1_physics, $cat1_biology, $cat1_chemistry, $cat1_geography, $cat1_history, $cat1_agriculture, $cat1_business_studies, $cat1_cre, $cat1_computer_studies, $cat2_maths, $cat2_english, $cat2_kiswahili, $cat2_physics, $cat2_biology, $cat2_chemistry, $cat2_geography, $cat2_history, $cat2_agriculture, $cat2_business_studies, $cat2_cre, $cat2_computer_studies, $end_term_maths, $end_term_english, $end_term_kiswahili, $end_term_physics, $end_term_biology, $end_term_chemistry, $end_term_geography, $end_term_history, $end_term_agriculture, $end_term_business_studies, $end_term_cre, $end_term_computer_studies);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie('success', 'results have been added 😉.', time() + 2);
    header("location: results.php");
}
function update_results()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $student_id = $_REQUEST['student_id'];
    $year = $_REQUEST['year'];
    $term = $_REQUEST['term'];
    $cat1_maths = $_REQUEST['cat1_maths'];
    $cat1_english = $_REQUEST['cat1_english'];
    $cat1_kiswahili = $_REQUEST['cat1_kiswahili'];
    $cat1_physics = $_REQUEST['cat1_physics'];
    $cat1_biology = $_REQUEST['cat1_biology'];
    $cat1_chemistry = $_REQUEST['cat1_chemistry'];
    $cat1_geography = $_REQUEST['cat1_geography'];
    $cat1_history = $_REQUEST['cat1_history'];
    $cat1_agriculture = $_REQUEST['cat1_agriculture'];
    $cat1_business_studies = $_REQUEST['cat1_business_studies'];
    $cat1_cre = $_REQUEST['cat1_cre'];
    $cat1_computer_studies = $_REQUEST['cat1_computer_studies'];
    $cat2_maths = $_REQUEST['cat2_maths'];
    $cat2_english = $_REQUEST['cat2_english'];
    $cat2_kiswahili = $_REQUEST['cat2_kiswahili'];
    $cat2_physics = $_REQUEST['cat2_physics'];
    $cat2_biology = $_REQUEST['cat2_biology'];
    $cat2_chemistry = $_REQUEST['cat2_chemistry'];
    $cat2_geography = $_REQUEST['cat2_geography'];
    $cat2_history = $_REQUEST['cat2_history'];
    $cat2_agriculture = $_REQUEST['cat2_agriculture'];
    $cat2_business_studies = $_REQUEST['cat2_business_studies'];
    $cat2_cre = $_REQUEST['cat2_cre'];
    $cat2_computer_studies = $_REQUEST['cat2_computer_studies'];
    $end_term_maths = $_REQUEST['end_term_maths'];
    $end_term_english = $_REQUEST['end_term_english'];
    $end_term_kiswahili = $_REQUEST['end_term_kiswahili'];
    $end_term_physics = $_REQUEST['end_term_physics'];
    $end_term_biology = $_REQUEST['end_term_biology'];
    $end_term_chemistry = $_REQUEST['end_term_chemistry'];
    $end_term_geography = $_REQUEST['end_term_geography'];
    $end_term_history = $_REQUEST['end_term_history'];
    $end_term_agriculture = $_REQUEST['end_term_agriculture'];
    $end_term_business_studies = $_REQUEST['end_term_business_studies'];
    $end_term_cre = $_REQUEST['end_term_cre'];
    $end_term_computer_studies = $_REQUEST['end_term_computer_studies'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE results SET `student_id` = '$student_id', `year` = '$year', `term` = '$term', `cat1_maths` = '$cat1_maths', `cat1_english` = '$cat1_english', `cat1_kiswahili` = '$cat1_kiswahili', `cat1_physics` = '$cat1_physics', `cat1_biology` = '$cat1_biology', `cat1_chemistry` = '$cat1_chemistry', `cat1_geography` = '$cat1_geography', `cat1_history` = '$cat1_history', `cat1_agriculture` = '$cat1_agriculture', `cat1_business_studies` = '$cat1_business_studies', `cat1_cre` = '$cat1_cre', `cat1_computer_studies` = '$cat1_computer_studies', `cat2_maths` = '$cat2_maths', `cat2_english` = '$cat2_english', `cat2_kiswahili` = '$cat2_kiswahili', `cat2_physics` = '$cat2_physics', `cat2_biology` = '$cat2_biology', `cat2_chemistry` = '$cat2_chemistry', `cat2_geography` = '$cat2_geography', `cat2_history` = '$cat2_history', `cat2_agriculture` = '$cat2_history', `cat2_business_studies` = '$cat2_business_studies', `cat2_cre` = '$cat2_cre', `cat2_computer_studies` = '$cat2_computer_studies', `end_term_maths` = '$end_term_maths', `end_term_english` = '$end_term_english', `end_term_kiswahili` = '$end_term_kiswahili', `end_term_physics` = '$end_term_physics', `end_term_biology` = '$end_term_biology', `end_term_chemistry` = '$end_term_chemistry', `end_term_geography` = '$end_term_geography', `end_term_history` = '$end_term_history', `end_term_agriculture` = '$end_term_agriculture', `end_term_business_studies` = '$end_term_business_studies', `end_term_cre` = '$end_term_cre', `end_term_computer_studies` = '$end_term_computer_studies' WHERE results_id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie("success", "results have been updated!", time() + 2);
    header('location: results.php');
}
function fetch_all_results(): mysqli_result|bool
{
    global $db_connection;

    $sql = $db_connection->query("SELECT * FROM results JOIN students ON students.student_id = results.student_id JOIN classes ON students.class_id = classes.class_id ") or die(mysqli_error($db_connection));
    return $sql;
}
function fetch_this_results(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $sql = $db_connection->query("SELECT * FROM results JOIN students ON students.student_id = results.student_id JOIN classes ON students.class_id = classes.class_id WHERE results_id = '$id' ") or die(mysqli_error($db_connection));
    return $sql;
}
function grade($total)
{
    if($total <= 100 && $total >= 95) echo 'A';
    elseif($total > 90 && $total <= 94) echo 'A-';
    elseif($total > 80 && $total <= 89) echo 'B+';
    elseif($total > 70 && $total <= 79) echo 'B';
    elseif($total > 60 && $total <= 69) echo 'B-';
    elseif($total > 50 && $total <= 59) echo 'C+';
    elseif($total > 40 && $total <= 49) echo 'C';
    elseif($total > 30 && $total <= 39) echo 'C-';
    elseif($total > 26 && $total <= 29) echo 'D+';
    elseif($total > 20 && $total <= 25) echo 'D';
    elseif($total > 10 && $total <= 19) echo 'D-';
    elseif($total > 0 && $total <= 9) echo 'E';
}

function add_marks()
{
    global $db_connection;

    $student_id = $_REQUEST['student_id'];
    $maths = $_REQUEST['maths'];
    $english = $_REQUEST['english'];
    $kiswahili = $_REQUEST['kiswahili'];
    $biology = $_REQUEST['biology'];
    $chemistry = $_REQUEST['chemistry'];
    $physics = $_REQUEST['physics'];
    $geography = $_REQUEST['geography'];
    $history = $_REQUEST['history'];
    $agriculture = $_REQUEST['agriculture'];
    $business_studies = $_REQUEST['business_studies'];
    $cre = $_REQUEST['cre'];
    $computer_studies = $_REQUEST['computer_studies'];
    $exam_type = $_REQUEST['exam_type'];
    $year = $_REQUEST['year'];
    $term = $_REQUEST['term'];
    $remarks = $_REQUEST['remarks'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO marks (`student_id`, `maths`, `english`, `kiswahili`, `biology`, `chemistry`, `physics`, `geography`, `history`, `agriculture`, `business_studies`, `cre`, `computer_studies`, `exam_type`, `year`, `term`, `remarks`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($sql_add, "iiiiiiiiiiiiisiis",$student_id, $maths, $english, $kiswahili, $biology, $chemistry, $physics, $geography, $history, $agriculture, $business_studies, $cre, $computer_studies, $exam_type, $year, $term, $remarks);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie('success', 'marks have been added 😉.', time() + 2);
    header("location: ./marks.php");
}
function update_marks()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $student_id = $_REQUEST['student_id'];
    $maths = $_REQUEST['maths'];
    $english = $_REQUEST['english'];
    $kiswahili = $_REQUEST['kiswahili'];
    $biology = $_REQUEST['biology'];
    $chemistry = $_REQUEST['chemistry'];
    $physics = $_REQUEST['physics'];
    $geography = $_REQUEST['geography'];
    $history = $_REQUEST['history'];
    $agriculture = $_REQUEST['agriculture'];
    $business_studies = $_REQUEST['business_studies'];
    $cre = $_REQUEST['cre'];
    $computer_studies = $_REQUEST['computer_studies'];
    $exam_type = $_REQUEST['exam_type'];
    $year = $_REQUEST['year'];
    $term = $_REQUEST['term'];
    $remarks = $_REQUEST['remarks'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE marks SET `student_id` = '$student_id', `maths` = '$maths', `english` = '$english', `kiswahili` = '$kiswahili', `biology` = '$biology', `chemistry` = '$chemistry', `physics` = '$physics', `geography` = '$geography', `history` = '$history', `agriculture` = '$agriculture', `business_studies` = '$business_studies', `cre` = '$cre', `computer_studies` = '$computer_studies', `exam_type` = '$exam_type', `year` = '$year', `term` = '$term', `remarks` = '$remarks' WHERE marks_id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie("success", "records have been updated!", time() + 2);
    header('location: marks.php');
}
function delete_marks()
{
    global $db_connection;

    $id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM students WHERE student_id = '$id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
    setcookie("success", "student has been deleted 😮.", time() + 2);
    header('location: ./students.php');
}
function fetch_this_marks(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $sql = $db_connection->query("SELECT * FROM marks JOIN students ON students.student_id = marks.student_id JOIN classes ON students.class_id = classes.class_id JOIN users ON users.id = classes.class_teacher_id WHERE marks_id = '$id' ") or die(mysqli_error($db_connection));
    return $sql;
}
function fetch_all_marks(): mysqli_result|bool
{
    global $db_connection;

    $sql = $db_connection->query("SELECT * FROM marks JOIN students ON students.student_id = marks.student_id JOIN classes ON students.class_id = classes.class_id ") or die(mysqli_error($db_connection));
    return $sql;
}


function calculate_total_sales(): int
{
    $total_sales = 0;
    foreach (fetch_all_sales() as $sale)
    {
        $total_sales += $sale['price'];
    }
    return $total_sales;
}

function update_user_profile()
{
    global $db_connection;
    $update_id = $_REQUEST['update_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email_address'];
    $tel = $_REQUEST['phone_number'];
    $password = $_REQUEST['password'];

    $sql_update_user_profile = mysqli_prepare($db_connection, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`phone_number` = '$tel', `email_address` = '$email', `password` = '$password'  WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_user_profile) or die(mysqli_stmt_error($sql_update_user_profile));
    setcookie("success", "profile updated. Login!", time() + 2);
    header('location: ../../index.php');
}
function logout()
{
session_start();
session_destroy();
header('location: ../../index.php');
}
if (isset($_POST["update_user_profile"])) update_user_profile();
if (isset($_POST['logout_btn'])) logout();
