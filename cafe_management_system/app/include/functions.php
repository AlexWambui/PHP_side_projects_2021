<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_cafe_pos";
$db_connection = mysqli_connect($hostname, $username, $password, $database)
or die("<b>Connection to the server couldn't be established. Try starting mysql on Xampp or contact the developer for help!</b>");

function protect_page()
{
    session_start();
    if (!isset($_SESSION['id'])) header("location: ../index.php");
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
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `username`, `password`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "sssss", $first_name, $last_name, $phone, $username, $password);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    setcookie("success", "Registered successfully!", time() + 2);
    header('location: ../_login.php');
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
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_level'] = $user['user_level'];
            header('location: app/welcome_page.php');
        } else {
            setcookie("error", "Try again!", time() + 2);
            header('location: ./index.php');
        }
    } else {
        setcookie("error", "Try again!", time() + 2);
        header('location: ./index.php');
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

function add_meal()
{
    global $db_connection;

    $category = $_REQUEST['category'];
    $meal_name = $_REQUEST['meal_name'];
    $price = $_REQUEST['price'];

    $target_dir = "uploads/";
    $target_file = $target_dir.rand(10000, 100000).basename($_FILES["food_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES["food_image"]["tmp_name"], $target_file)){
        $status = 1;
    }
    else
    {
        $status = 2;
    }

    $sql_add_meal = mysqli_prepare($db_connection, "INSERT INTO meals (`meal_name`, `category`, `price`, `picture_of_meal`) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_add_meal, "ssds", $meal_name, $category, $price, $target_file);
    mysqli_stmt_execute($sql_add_meal) or die(mysqli_stmt_error($sql_add_meal));
    setcookie("success", 'Meal added successfully', time() + 2);
    header('location: ./meals.php');
}
function update_meal()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $category = $_REQUEST['category'];
    $meal_name = $_REQUEST['meal_name'];
    $price = $_REQUEST['price'];

    $sql_update_meal = mysqli_prepare($db_connection, "UPDATE meals SET `meal_name` = '$meal_name', `category` = '$category', `price` = '$price' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_meal) or die(mysqli_stmt_error($sql_update_meal));
    setcookie('success', 'Meal updated successfully 😉.', time() + 2);
    header('location: ./meals.php');
}
function delete_meal()
{
    delete('meals');
    setcookie("success", "Meal has been deleted 😮.", time() + 2);
    header('location: ./meals.php');
}
function fetch_category($category_name): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_category = $db_connection->query("SELECT * FROM meals WHERE category = '$category_name' ") or die(mysqli_error($db_connection));
    return $sql_fetch_category;
}
function select_meal_options(): string
{
    $output = '';
    foreach (fetch_all('meals') as $meal) {
        $output .= '<option value="'.$meal["id"].'">'.$meal["meal_name"].' @ '.$meal["price"].'</option>';
    }
    return $output;
}

function add_sale()
{
    global $db_connection;

    $meal_id = $_REQUEST['meal_id'];
    $quantity = $_REQUEST['quantity'];
    $payment_method = $_REQUEST['payment_method'];

    $sql_add_sale = mysqli_prepare($db_connection, "INSERT INTO sales (`meal_id`, `quantity`, `payment_method`) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sql_add_sale, "iii", $meal_id, $quantity, $payment_method);
    mysqli_stmt_execute($sql_add_sale) or die(mysqli_stmt_error($sql_add_sale));
    setcookie("success", 'Sale added successfully', time() + 2);
    header('location: ./sales.php');
}
function update_sale()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $meal_id = $_REQUEST['meal_id'];
    $quantity = $_REQUEST['quantity'];
    $payment_method = $_REQUEST['payment_method'];

    $sql_update_sale = mysqli_prepare($db_connection, "UPDATE sales SET `meal_id` = '$meal_id', `quantity` = '$quantity', `payment_method` = '$payment_method' WHERE sales.id = '$id' ");
    mysqli_stmt_execute($sql_update_sale) or die(mysqli_stmt_error($sql_update_sale));
    setcookie('success', 'Sale updated successfully 😉.', time() + 2);
    header('location: ./sales.php');
}
function delete_sale()
{
    delete('sales');
    setcookie("success", "Sale has been deleted 😮.", time() + 2);
    header('location: ./sales.php');
}
function fetch_all_sales(): mysqli_result|bool
{
    global $db_connection;

    return $db_connection->query("SELECT sales.id AS sale_id, sales.quantity, sales.payment_method, meals.id AS meal_id, meals.meal_name, meals.category, meals.price FROM sales JOIN meals ON sales.meal_id = meals.id");
}
function fetch_all_sales_today(): mysqli_result|bool
{
    global $db_connection;

    $today = date("Y-m-d");
    return $db_connection->query("SELECT sales.id AS sale_id, sales.quantity, sales.payment_method, meals.id AS meal_id, meals.meal_name, meals.category, meals.price FROM sales JOIN meals ON sales.meal_id = meals.id WHERE sales.date_created = '$today' ");
}
function fetch_this_sale(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT sales.id AS sale_id, sales.quantity, sales.payment_method, meals.id AS meal_id, meals.meal_name, meals.category, meals.price FROM sales JOIN meals ON sales.meal_id = meals.id WHERE sales.id = '$id' ");
}
function count_sales_today(): int
{
    return mysqli_num_rows(fetch_all_sales_today());
}
function profit_today(): int
{
    $profit_today = 0;
    foreach (fetch_all_sales_today() as $sale)
    {
        $profit_today += $sale['price'] * $sale['quantity'];
    }
    return $profit_today;
}
function total_profit(): int
{
    $total_profit = 0;
    foreach (fetch_all_sales() as $sale)
    {
        $total_profit += $sale['price'] * $sale['quantity'];
    }
    return $total_profit;
}
function count_category_occurence($category): mysqli_result|bool
{
    global $db_connection;

    $sql = $db_connection->query("SELECT sales.id AS sale_id, sales.quantity, sales.payment_method, meals.id AS meal_id, meals.meal_name, meals.category, meals.price FROM sales JOIN meals ON sales.meal_id = meals.id WHERE meals.category = '$category' ");
    return mysqli_num_rows($sql);
}

function update_user_profile()
{
    global $db_connection;
    $update_id = $_REQUEST['update_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $tel = $_REQUEST['phone_number'];
    $password = $_REQUEST['password'];

    $sql_update_user_profile = mysqli_prepare($db_connection, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`phone_number` = '$tel', `password` = '$password'  WHERE id = '$update_id' ");
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
if (isset($_POST['signup_btn'])) signup_user();
if (isset($_POST["update_user_profile"])) update_user_profile();
if (isset($_POST['logout_btn'])) logout();
