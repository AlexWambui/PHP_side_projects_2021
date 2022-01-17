<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_bookshop_ms";
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
    $password = $_REQUEST['password'];
    $user_level = 1;

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `email_address`, `password`, `user_level`) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "sssssi", $first_name, $last_name, $phone, $email, $password, $user_level,);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    setcookie("success", "Registered successfully!", time() + 2);
    header('location: ../../index.php');
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

function add_book()
{
    global $db_connection;

    $category = $_REQUEST['category'];
    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];

    $target_dir = "uploads/";
    $target_file = $target_dir.rand(10000, 100000).basename($_FILES["book_cover"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES["book_cover"]["tmp_name"], $target_file)){
        $status = 1;
    }
    else
    {
        $status = 2;
    }

    $sql_add_book = mysqli_prepare($db_connection, "INSERT INTO books (`category`,`title`, `author`, `description`, `price`, `book_cover`) VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($sql_add_book, "ssssis",$category, $title, $author, $description, $price, $target_file);
    mysqli_stmt_execute($sql_add_book) or die(mysqli_stmt_error($sql_add_book));
    setcookie('success', 'book has been added 😉.', time() + 3);
    header("location: ./books.php");
}
function update_book()
{
    global $db_connection;

    $update_id = $_REQUEST['update_id'];
    $category = $_REQUEST['category'];
    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];

    $sql_update_book = mysqli_prepare($db_connection, "UPDATE books SET `category` = '$category', `title` = '$title', `author` = '$author', `description` = '$description', `price` = '$price' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_book) or die(mysqli_stmt_error($sql_update_book));
    setcookie("success", "Book details updated!", time() + 2);
    header('location: books.php');
}
function delete_book()
{
    delete('books');
    setcookie("success", "Book has been deleted 😮.", time() + 2);
    header('location: ./books.php');
}
function select_books_options(): string
{
    $output = '';
    foreach (fetch_all('books') as $book) {
        $output .= '<option value="'.$book["id"].'">'.$book["title"].' (author: '.$book["author"].')</option>';
    }
    return $output;
}

function add_sale()
{
    global $db_connection;

    $book_id = $_REQUEST['book'];
    $customer = $_REQUEST['customer_names'];

    $sql_add_sale = mysqli_prepare($db_connection, "INSERT INTO sales (`book_id`, `customer_names`) VALUES(?,?)");
    mysqli_stmt_bind_param($sql_add_sale, "is", $book_id, $customer);
    mysqli_stmt_execute($sql_add_sale) or die(mysqli_stmt_error($sql_add_sale));
    setcookie("success", 'Sales saved successfully', time() + 2);
    header('location: ./sell.php');
}
function update_sale()
{
    global $db_connection;

    $id = $_REQUEST['sale_id'];
    $book_id = $_REQUEST['book'];
    $customer = $_REQUEST['customer_name'];

    $sql_update_sale = mysqli_prepare($db_connection, "UPDATE sales SET `book_id` = '$book_id', `customer_names` = '$customer' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_sale) or die(mysqli_stmt_error($sql_update_sale));
    setcookie('success', 'sale updated successfully 😉.', time() + 2);
    header('location: ./sell.php');
}
function delete_sale()
{
    delete('sales');
    setcookie("success", "Sale has been deleted 😮.", time() + 2);
    header('location: ./sell.php');
}
function fetch_all_sales(): mysqli_result|bool
{
    global $db_connection;

    return $db_connection->query("SELECT sales.id AS sale_id, customer_names, books.id AS book_id, category, title, author, price FROM sales JOIN books ON sales.book_id = books.id");
}
function fetch_this_sale(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT sales.id AS sale_id, customer_names, books.id AS book_id, category, title, author, description, price FROM sales JOIN books ON sales.book_id = books.id WHERE sales.id = '$id' ");
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
if (isset($_POST['signup_btn'])) signup_user();
if (isset($_POST["update_user_profile"])) update_user_profile();
if (isset($_POST['logout_btn'])) logout();
