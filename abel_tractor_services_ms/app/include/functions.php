<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_abel_tractor_services_ms";
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
            header('location: app/welcome_page.php');
        } else {
            setcookie("error", "Wrong Credentials!", time() + 2);
            header('location: ./index.php');
        }
    } else {
        setcookie("error", "Wrong Credentials!", time() + 2);
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

if (isset($_POST['btn_update_service']))
{
    $update_id = $_REQUEST['update_id'];
    $tractor_name = $_REQUEST['tractor_name'];
    $service_name = $_REQUEST['service_name'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];
    $sql_update_service = mysqli_prepare($db_connection, "UPDATE services SET `tractor_name` = '$tractor_name', `service_name` = '$service_name', `description` = '$description', `price` = '$price' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_service) or die(mysqli_stmt_error($sql_update_service));
    setcookie("success", "service updated!", time() + 2);
    header('location: ../tractors.php');
}
function add_service()
{
    global $db_connection;

    $tractor = $_REQUEST['tractor_name'];
    $service = $_REQUEST['service_name'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];

    $target_dir = "uploads/";
    $target_file = $target_dir.rand(10000, 100000).basename($_FILES["tractor_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES["tractor_image"]["tmp_name"], $target_file)){
        $status = 1;
    }
    else
    {
        $status = 2;
    }

    $sql_add_service = mysqli_prepare($db_connection, "INSERT INTO services (`tractor_name`,`service_name`, `description`, `price`, `tractor_image`) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($sql_add_service, "sssis",$tractor, $service, $description, $price, $target_file);
    mysqli_stmt_execute($sql_add_service) or die(mysqli_stmt_error($sql_add_service));
    setcookie('success', 'service added', time() + 3);
    header("location: ./tractors.php");
}
function delete_service()
{
    delete('services');
    setcookie("success", "service deleted!!!", time() + 2);
    header('location: ./tractors.php');
}
function select_services_options(): string
{
    $output = '';
    foreach (fetch_all('services') as $service) {
        $output .= '<option value="' . $service["id"] . '">' . $service["service_name"] . '</option>';
    }
    return $output;
}

if (isset($_POST['delete_request'])) {
    delete('requests');
    setcookie("success", "request deleted!!!", time() + 2);
    header('location: ../requests.php');
}
if (isset($_POST['btn_update_request'])) {
    $update_id = $_REQUEST['update_id'];
    $date_required = $_REQUEST['date_required'];
    $sql_update_request = mysqli_prepare($db_connection, "UPDATE requests SET `date_required` = '$date_required' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_request) or die(mysqli_stmt_error($sql_update_request));
    header('location: ../requests.php');
}
if (isset($_POST['approve_request']))
{
    $approval_id = $_REQUEST['approval_id'];
    $approval = 'approved';
    $sql_update_request = mysqli_prepare($db_connection, "UPDATE requests SET `status` = '$approval' WHERE id = '$approval_id' ");
    mysqli_stmt_execute($sql_update_request) or die(mysqli_stmt_error($sql_update_request));
    header('location: ../requests.php');
}
if (isset($_POST['reject_request']))
{
    $approval_id = $_REQUEST['reject_id'];
    $approval = 'rejected';
    $sql_update_request = mysqli_prepare($db_connection, "UPDATE requests SET `status` = '$approval' WHERE id = '$approval_id' ");
    mysqli_stmt_execute($sql_update_request) or die(mysqli_stmt_error($sql_update_request));
    header('location: ../requests.php');
}
function add_request()
{
    global $db_connection;
    $user_id = $_REQUEST['user_id'];
    $service_id = $_REQUEST['service_id'];
    $date_required = $_REQUEST['date_required'];

    $sql_add_request = mysqli_prepare($db_connection, "INSERT INTO requests (`user_id`, `service_id`, `date_required`) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sql_add_request, "iis", $user_id, $service_id, $date_required);
    mysqli_stmt_execute($sql_add_request) or die(mysqli_stmt_error($sql_add_request));
    header('location: requests.php');
}
function fetch_requests(): mysqli_result|bool
{
    global $db_connection;
    $sql_fetch_user_requests = $db_connection->query("SELECT *, requests.id AS request_id FROM requests INNER JOIN users ON users.id = requests.user_id INNER JOIN services ON services.id = requests.service_id") or die(mysqli_error($db_connection));
    return $sql_fetch_user_requests;
}
function fetch_user_requests(): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['id'];
    $sql_fetch_user_requests = $db_connection->query("SELECT *, requests.id AS request_id FROM requests INNER JOIN users ON users.id = requests.user_id INNER JOIN services ON services.id = requests.service_id WHERE requests.user_id = '$id'") or die(mysqli_error($db_connection));
    return $sql_fetch_user_requests;
}
function count_user_requests(): int
{
    return mysqli_num_rows(fetch_user_requests());
}
function count_user_pending_requests(): int
{
    global $db_connection;
    $id = $_SESSION['id'];
    $sql_fetch_user_requests = $db_connection->query("SELECT * FROM requests INNER JOIN users ON users.id = requests.user_id INNER JOIN services ON services.id = requests.service_id WHERE requests.user_id = '$id'AND requests.status = '-' ") or die(mysqli_error($db_connection));
    return mysqli_num_rows(($sql_fetch_user_requests));
}
function count_all_pending_requests(): int
{
    global $db_connection;
    $sql_fetch_user_requests = $db_connection->query("SELECT * FROM requests WHERE requests.status = '-' ") or die(mysqli_error($db_connection));
    return mysqli_num_rows(($sql_fetch_user_requests));
}
function users_requests_rows()
{
    foreach (fetch_user_requests() as $request): ?>
        <tr>
            <?php if ($_SESSION['user_level'] == 2): ?>
                <td><?= $request['first_name'] . ' ' . $request['last_name'] ?></td>
            <?php endif; ?>
            <td><?= $request['service_name'] ?></td>
            <td><?= $request['date_required'] ?></td>
            <td class="<?php if($request['status'] == 'approved') echo 'text-success';?>"><?= $request['status'] ?></td>
            <td>
                <div class="action_buttons_wrapper">
                    <div class="action_buttons">
                        <form action="update_request_form.php" method="post">
                            <input type="hidden" name="update_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-success btn-sm"
                                    name="update_request"><span class="icon-pencil"></span> Edit
                            </button>
                        </form>
                    </div>
                    <div class="action_buttons">
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="delete_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm"
                                    name="delete_request"><span class="icon-trash"></span> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach;
}
function admin_requests_rows()
{
    foreach (fetch_requests() as $request): ?>
        <tr>
            <?php if ($_SESSION['user_level'] == 2): ?>
                <td><?= $request['first_name'] . ' ' . $request['last_name'] ?></td>
            <?php endif; ?>
            <td><?= $request['service_name'] ?></td>
            <td><?= $request['date_required'] ?></td>
            <td class="<?php if($request['status'] == 'approved') echo 'text-success'; ?>"><?= $request['status'] ?></td>
            <td>
                <div class="action_buttons_wrapper">
                    <div class="action_buttons">
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="approval_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-success btn-sm"
                                    name="approve_request"><span class="icon-check"></span> Approve
                            </button>
                        </form>
                    </div>
                    <div class="action_buttons">
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="reject_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-warning btn-sm"
                                    name="reject_request"><span class="icon-times"></span> Reject
                            </button>
                        </form>
                    </div>
                    <div class="action_buttons">
                        <form action="reports.php" method="post">
                            <input type="hidden" name="print_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-info btn-sm"
                                    name="print_request"><span class="icon-print"></span> Print
                            </button>
                        </form>
                    </div>
                    <div class="action_buttons">
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="delete_id"
                                   value="<?= $request['request_id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm"
                                    name="delete_request"><span class="icon-trash"></span> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach;
}
function fetch_user_request_print(): mysqli_result|bool
{
    global $db_connection;
    $id = $_REQUEST['print_id'];
    $sql_fetch_user_requests = $db_connection->query("SELECT *, requests.id AS request_id FROM requests INNER JOIN users ON users.id = requests.user_id INNER JOIN services ON services.id = requests.service_id WHERE requests.id = '$id' ") or die(mysqli_error($db_connection));
    return $sql_fetch_user_requests;
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
if (isset($_POST["update_user_profile"])) update_user_profile();

function logout()
{
session_start();
session_destroy();
header('location: ../../index.php');
}
if (isset($_POST['logout'])) logout();
