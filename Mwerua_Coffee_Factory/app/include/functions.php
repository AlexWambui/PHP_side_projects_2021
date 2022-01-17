<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_mwerua_factory";
$db_connection = mysqli_connect($hostname, $username, $password, $database);

function protect_page()
{
    session_start();
    if(!isset($_SESSION['id'])){
        //Redirect the user to login page
        header("location: login_page.php");
    }
}
function alert()
{
    if(isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oooops!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_COOKIE['success'])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> <?= $_COOKIE['success'] ?>
        </div>
    <?php endif;
}

//signup
if (isset($_POST["signup_button"]))
{
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $dob = $_REQUEST['date_of_birth'];
    $id_number = $_REQUEST['id_number'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];
    $user_level = 1;

    $sql_signup_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `date_of_birth`, `national_id`, `phone_number`, `email_address`, `password`, `user_level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_signup_user, "sssisssi", $first_name, $last_name, $dob, $id_number, $phone, $email, $password, $user_level,);
    mysqli_stmt_execute($sql_signup_user) or die(mysqli_stmt_error($sql_signup_user));
    setcookie("success", "Registered successfully!", time() + 2);
    header('location: ../login_page.php');
}
//login
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
    if(mysqli_num_rows($fetched_users) == 1)
    {
        $user = mysqli_fetch_assoc($fetched_users);
        if ($user['password'] == $password)
        {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['id_number'] = $user['national_id'];
            $_SESSION['email'] = $user['email_address'];
            $_SESSION['user_level'] = $user['user_level'];
            header('location: welcome_page.php');
        }
        else
        {
            setcookie("error", "Try again!", time() + 2);
            header('location: login_page.php');
        }
    }
    else
    {
        setcookie("error", "Try again!", time()+2);
        header('location: login_page.php');
    }
}

//update_user
if(isset($_POST["update_user"]))
{
    $update_id = $_REQUEST['update_user_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $dob = $_REQUEST['date_of_birth'];
    $id_number = $_REQUEST['id_number'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];

    $sql_update_user = mysqli_prepare($db_connection, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`date_of_birth`='$dob', `national_id` = '$id_number', `phone_number` = '$phone', `email_address` = '$email'  WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_user) or die(mysqli_stmt_error($sql_update_user));
    header('location: ../users.php');
}
//update_user_profile
if(isset($_POST["update_user_profile"]))
{
    $update_user_profile_id = $_REQUEST['update_user_profile_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $dob = $_REQUEST['date_of_birth'];
    $id_number = $_REQUEST['id_number'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    $sql_update_user = mysqli_prepare($db_connection, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`date_of_birth`='$dob', `national_id` = '$id_number', `phone_number` = '$phone', `email_address` = '$email', `password` = '$password'  WHERE id = '$update_user_profile_id' ");
    mysqli_stmt_execute($sql_update_user) or die(mysqli_stmt_error($sql_update_user));
    header('location: ../profile_page.php');
}
if(isset($_POST['delete_user']))
{
    $id = $_REQUEST['user_id'];
    $sql_delete_user = $db_connection->query("DELETE FROM users WHERE id = '$id' ") or die(mysqli_error($db_connection));
    header('location: ../users.php');
}
function fetch_users(): mysqli_result|bool
{
    global $db_connection;
    $fetched_users = $db_connection->query("SELECT * FROM users") or die (mysqli_error($db_connection));
    return $fetched_users;
}
function display_all_users(): array
{
    return mysqli_fetch_all(fetch_users(), 1);
}
function count_users():int
{
    return mysqli_num_rows(fetch_users());
}
function fetch_user(): array
{
    global $db_connection;
    $id = $_REQUEST['update_id'];
    $fetched_user = $db_connection->query("SELECT * FROM users WHERE id = '$id' ") or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_user, 1);
}
function fetch_user_profile(): array
{
    global $db_connection;
    $id = $_SESSION['id'];
    $profile = $db_connection->query("SELECT * FROM users WHERE id = '$id' ") or die(mysqli_error($db_connection));
    return mysqli_fetch_all($profile, 1);
}
function select_user_select_option(): string
{
    $output = '';
    foreach (display_all_users() as $user){
        $output .='<option value="'.$user["id"].'">'.$user["email_address"].'</option>';
    }
    return $output;
}
function update_user_select_options($id): string
{
    $output = '';
    foreach (display_all_users() as $update_user){
        $selected = $id == $update_user['id'] ? 'selected': '';
        $output .='<option '.$selected.' value=" '.$update_user["id"].' ">'.$update_user["email_address"].'</option>';
    }
    return $output;
}


//save_payments
if(isset($_POST["save_payment"]))
{
    $users_id = $_REQUEST['users_id'];
    $date = $_REQUEST['date_collected'];
    $amount = $_REQUEST['amount_in_kgs'];

    $sql_add_payment = mysqli_prepare($db_connection, "INSERT INTO payments (`user_id`, `date_collected`, `amount_in_kgs`) VALUES (?, ?, ?) ");
    mysqli_stmt_bind_param($sql_add_payment, "isi", $users_id, $date, $amount);
    mysqli_stmt_execute($sql_add_payment) or die(mysqli_stmt_error($sql_add_payment));
    header('location: ../payments.php');
}
//update_payment
if(isset($_POST["update_payment"]))
{
    $update_id = $_REQUEST['update_id'];
    $id_number = $_REQUEST['id_number'];
    $date = $_REQUEST['date_collected'];
    $amount = $_REQUEST['amount_in_kgs'];

    $sql_update_payment = mysqli_prepare($db_connection, "UPDATE `payments` SET `user_id`='$id_number',`date_collected`='$date',`amount_in_kgs`='$amount' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_payment) or die(mysqli_stmt_error($sql_update_payment));
    header('location: ../payments.php');
}
if(isset($_POST['pay_user']))
{
    $id = $_REQUEST['payment_id'];
    $paid = 'paid';

    $sql_pay_user = mysqli_prepare($db_connection, "UPDATE payments SET `payment_status` = '$paid' WHERE id= '$id' ");
    mysqli_stmt_execute($sql_pay_user) or die(mysqli_stmt_error($sql_pay_user));
    header('location: ../reports.php');
}
if(isset($_POST["delete_payment"]))
{
    $id = $_REQUEST['delete_payment_id'];
    $sql_delete_payment = mysqli_prepare($db_connection,"DELETE FROM payments WHERE id = '$id' ");
    mysqli_stmt_execute($sql_delete_payment) or die(mysqli_stmt_error($sql_delete_payment));
    header('location: ../payments.php');
}
function payments(): array
{
    global $db_connection;
    $id = $_REQUEST['update_id'];
    $sql_fetch_payments = "SELECT payments.id AS payment_id, tbl_users.id AS user_id, national_id, email_address, date_collected, amount_in_kgs FROM payments LEFT JOIN users AS tbl_users ON payments.user_id = tbl_users.id WHERE payments.id = '$id' ";
    $fetched_payments = mysqli_query($db_connection, $sql_fetch_payments) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_payments, 1);
}
function fetch_payments(): array
{
    global $db_connection;
    $sql_fetch_payments = "SELECT payments.id AS payment_id, tbl_users.id AS user_id, first_name, last_name, date_collected, amount_in_kgs, payment_status FROM payments LEFT JOIN users AS tbl_users ON payments.user_id = tbl_users.id ";
    $fetched_payments = mysqli_query($db_connection, $sql_fetch_payments) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_payments, 1);
}
function fetch_user_payment():array{
    global $db_connection;
    $id = $_REQUEST['payment_id'];
    $sql_fetch_payments = "SELECT payments.id AS payment_id, tbl_users.id AS user_id, first_name, last_name, email_address, date_collected, amount_in_kgs, payment_status FROM payments LEFT JOIN users AS tbl_users ON payments.user_id = tbl_users.id WHERE payments.id = '$id' ";
    $fetched_payments = mysqli_query($db_connection, $sql_fetch_payments) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_payments, 1);
}
function fetch_user_payments(): array
{
    global $db_connection;
    $id = $_SESSION['id'];
    $sql_fetch_payments = "SELECT * FROM payments JOIN users ON payments.user_id = users.id WHERE users.id = '$id' ";
    $fetched_payments = mysqli_query($db_connection, $sql_fetch_payments) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_payments, 1);
}
function calc_kgs_collected_by_user():?int
{
    global $db_connection;
    $id = $_SESSION['id'];
    $fetched_kgs = mysqli_fetch_assoc($db_connection->query("SELECT SUM(amount_in_kgs) AS total_kgs_collected FROM payments LEFT JOIN users ON payments.user_id = users.id WHERE users.id = '$id' "));
    return $fetched_kgs['total_kgs_collected'];
}
function calc_user_earnings(): ?int
{
    return calc_kgs_collected_by_user() * 100;
}
function calc_user_earnings_paid(): ?int
{
    global $db_connection;
    $id = $_SESSION['id'];
    $fetched_kgs = mysqli_fetch_assoc($db_connection->query("SELECT SUM(amount_in_kgs) AS total_kgs_collected FROM payments LEFT JOIN users ON payments.user_id = users.id WHERE users.id = '$id' AND payment_status = 'paid'"));
    return $fetched_kgs['total_kgs_collected'] * 100;
}
function calc_user_earnings_unpaid(): ?int
{
    global $db_connection;
    $id = $_SESSION['id'];
    $fetched_kgs = mysqli_fetch_assoc($db_connection->query("SELECT SUM(amount_in_kgs) AS total_kgs_collected FROM payments LEFT JOIN users ON payments.user_id = users.id WHERE users.id = '$id' AND payment_status = '-'"));
    return $fetched_kgs['total_kgs_collected'] * 100;
}
function count_unpaid(): int
{
    global $db_connection;
    return mysqli_num_rows($db_connection->query("SELECT * FROM payments WHERE payment_status = '-' "));
}
function count_paid(): int
{
    global $db_connection;
    return mysqli_num_rows($db_connection->query("SELECT * FROM payments WHERE payment_status = 'paid' "));
}


if(isset($_POST["send_feedback"]))
{
    session_start();
    $session_id = $_SESSION['id'];
    $message = $_REQUEST['feedback'];

    $sql_insert_feedback = mysqli_prepare($db_connection, "INSERT INTO feedbacks (`user_id`, `message`) VALUES (?, ?)");
    mysqli_stmt_bind_param($sql_insert_feedback, "is", $session_id, $message);
    mysqli_stmt_execute($sql_insert_feedback) or die(mysqli_stmt_error($sql_insert_feedback));
    header('location: ../feedbacks.php');
}
if (isset($_POST['respond_to_feedback']))
{
    $id = $_REQUEST['update_feedback_id'];
    $response = $_REQUEST['response'];

    $sql_respond_to_feedback = mysqli_prepare($db_connection, "UPDATE feedbacks SET `response` = '$response' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_respond_to_feedback) or die(mysqli_error($db_connection));
    header('location: ../feedbacks.php');
}
function fetch_user_feedbacks(): array
{
    global $db_connection;
    $session_id = $_SESSION['id'];

    $sql_fetch_feedbacks = "SELECT feedbacks.id AS feedback_id, tbl_users.id AS user_id, first_name, last_name, message, response, feedbacks.date_created FROM feedbacks LEFT JOIN users AS tbl_users ON feedbacks.user_id = tbl_users.id WHERE feedbacks.user_id = '$session_id' ";
    $fetched_feedbacks = mysqli_query($db_connection, $sql_fetch_feedbacks) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($fetched_feedbacks, 1);
}
function count_unread_feedbacks():int
{
    global $db_connection;
    $session_id = $_SESSION['id'];

    $sql_count_unread_feedbacks = $db_connection->query("SELECT feedbacks.id AS feedback_id, tbl_users.id AS user_id, first_name, last_name, message, response, feedbacks.date_created FROM feedbacks LEFT JOIN users AS tbl_users ON feedbacks.user_id = tbl_users.id WHERE feedbacks.response = 'no_response' ");
    return mysqli_num_rows($sql_count_unread_feedbacks);
}
function fetch_feedbacks(): array
{
    global $db_connection;

    $sql_fetch_all_feedbacks = "SELECT feedbacks.id AS feedback_id, tbl_users.id AS user_id, first_name, last_name, message, response, feedbacks.date_created FROM feedbacks LEFT JOIN users AS tbl_users ON feedbacks.user_id = tbl_users.id";
    $all_feedbacks = mysqli_query($db_connection, $sql_fetch_all_feedbacks) or die (mysqli_error($db_connection));
    return mysqli_fetch_all($all_feedbacks, 1);
}
function reply_to_feedback(): array
{
    global $db_connection;
    $id = $_REQUEST['update_feedback_id'];

    $sql_fetch_all_feedbacks = $db_connection->query("SELECT feedbacks.id AS feedback_id, tbl_users.id AS user_id, first_name, last_name, message, response, feedbacks.date_created FROM feedbacks LEFT JOIN users AS tbl_users ON feedbacks.user_id = tbl_users.id WHERE feedbacks.id = '$id' ") or die (mysqli_error($db_connection));
    return mysqli_fetch_all($sql_fetch_all_feedbacks, 1);
}
