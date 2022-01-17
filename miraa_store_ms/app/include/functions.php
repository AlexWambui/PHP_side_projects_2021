<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_miraa_store_ms";
$db_connection = mysqli_connect($hostname, $username, $password, $database)
or die("<b>Connection to the server couldn't be established. Try starting mysql on Xampp or contact the developer for help!</b>");

function protect_page()
{
    session_start();
    if (!isset($_SESSION['id'])) header("location: ../index.php");
}
function admin_page()
{
    session_start();
    if ($_SESSION['user_level'] != 2) header('location: welcome_page.php');
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
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `email_address`, `username`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "ssssss", $first_name, $last_name, $phone, $email, $username, $password);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    setcookie("success", "Registered successfully!", time() + 2);
    header('location: login.php');
}
function login()
{
    global $db_connection;

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_fetch_users = mysqli_prepare($db_connection, "SELECT * FROM users WHERE username = ? LIMIT 1");
    mysqli_stmt_bind_param($sql_fetch_users, "s", $username);
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

function add_purchase()
{
    global $db_connection;

    $farmer = $_REQUEST['farmers_names'];
    $email = $_REQUEST['email_address'];
    $amount = $_REQUEST['amount_in_kgs'];
    $cost = $_REQUEST['cost_per_kg'];

    $sql_add_purchase = mysqli_prepare($db_connection, "INSERT INTO purchases (`farmers_names`, `email_address`, `amount_in_kgs`, `cost_per_kg`) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($sql_add_purchase, "ssdd",$farmer, $email, $amount, $cost);
    mysqli_stmt_execute($sql_add_purchase) or die(mysqli_stmt_error($sql_add_purchase));
    setcookie('success', 'Purchase has been added 😉.', time() + 2);
    header("location: ./purchases.php");
}
function update_purchase()
{
    global $db_connection;

    $update_id = $_REQUEST['update_id'];
    $farmer = $_REQUEST['farmers_names'];
    $email = $_REQUEST['email_address'];
    $amount = $_REQUEST['amount_in_kgs'];
    $cost = $_REQUEST['cost_per_kg'];

    $sql_update_purchase = mysqli_prepare($db_connection, "UPDATE purchases SET `farmers_names` = '$farmer', `email_address` = '$email', `amount_in_kgs` = '$amount', `cost_per_kg` = '$cost' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_purchase) or die(mysqli_stmt_error($sql_update_purchase));
    setcookie("success", "Purchase updated!", time() + 2);
    header('location: purchases.php');
}
function delete_purchase()
{
    delete('purchases');
    setcookie("success", "Purchase has been deleted 😮.", time() + 2);
    header('location: ./purchases.php');
}
function total_purchases(): float|int
{
    $total = 0;
    foreach(fetch_all('purchases') as $purchase)
    {
        $total += $purchase['amount_in_kgs'] * $purchase['cost_per_kg'];
    }
    return $total;
}
function purchases_today(): float|int
{
    global $db_connection;

    $date_today = date('Y-m-d');
    $sql_fetch_purchases_today = $db_connection->query("SELECT * FROM purchases WHERE date_created = '$date_today' ");
    $purchases_today = mysqli_fetch_all($sql_fetch_purchases_today, 1);
    $total = 0;
    foreach($purchases_today as $purchase)
    {
        $total += $purchase['amount_in_kgs'] * $purchase['cost_per_kg'];
    }
    return $total;
}

function add_sale()
{
    global $db_connection;

    $customer = $_REQUEST['customers_names'];
    $amount_in_kgs = $_REQUEST['amount_in_kgs'];
    $cost_per_kg = $_REQUEST['cost_per_kg'];

    $sql_add_sale = mysqli_prepare($db_connection, "INSERT INTO sales (`customers_names`, `amount_in_kgs`, `cost_per_kg`) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sql_add_sale, "sdd", $customer, $amount_in_kgs, $cost_per_kg);
    mysqli_stmt_execute($sql_add_sale) or die(mysqli_stmt_error($sql_add_sale));
    setcookie("success", 'Sales saved successfully', time() + 2);
    header('location: ./sales.php');
}
function update_sale()
{
    global $db_connection;

    $id = $_REQUEST['sale_id'];
    $customer = $_REQUEST['customers_names'];
    $amount_in_kgs = $_REQUEST['amount_in_kgs'];
    $cost_per_kg = $_REQUEST['cost_per_kg'];

    $sql_update_sale = mysqli_prepare($db_connection, "UPDATE sales SET `customers_names` = '$customer', `amount_in_kgs` = '$amount_in_kgs', `cost_per_kg` = '$cost_per_kg' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_sale) or die(mysqli_stmt_error($sql_update_sale));
    setcookie('success', 'sale updated successfully 😉.', time() + 2);
    header('location: ./sales.php');
}
function delete_sale()
{
    delete('sales');
    setcookie("success", "Sale has been deleted 😮.", time() + 2);
    header('location: ./sales.php');
}
function total_sales(): float|int
{
    $total = 0;
    foreach(fetch_all('sales') as $sale)
    {
        $total += $sale['amount_in_kgs'] * $sale['cost_per_kg'];
    }
    return $total;
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
