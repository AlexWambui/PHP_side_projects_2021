<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php"?>
    <title>Feedbacks</title>
</head>
<body>
<?php include_once "include/sidenav.php" ?>
<section class="main_content">
<?php if($_SESSION['user_level'] == 1):?>
<div class="row justify-content-center">
    <div class="col-sm-9">
        <div class="card feedback_form">
            <div class="card-header _card_header">
                <p class="text-center"><?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
            </div>
            <div class="card-body">
                <?php foreach(fetch_user_feedbacks() as $feedback): ?>
                <p class="float-left feedback_message"><?= $feedback['message'] ?> <span class="float-right _small_text"><?= $feedback['date_created'] ?></span></p>
                <p class="float-right feedback_response">
                    <?php
                    if($feedback['response'] == 'no_response')
                        echo "<i>Wait for admin's reply...</i>😉";
                    else
                        echo $feedback['response'];
                    ?>
                </p>
                <?php endforeach; ?>
            </div>
            <div class="card-footer _card_header">
                <form action="include/functions.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-11">
                            <input type="text" name="feedback" id="feedback" class="form-control" placeholder="Message" required>
                        </div>
                        <div class="col-1">
                            <button type="submit" name="send_feedback" id="send_feedback" class="btn btn-light"><span class="icon-send2"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if($_SESSION['user_level'] == 2): ?>
<div class="card">
    <h5 class="card-header _card_header">Feedbacks</h5>
    <div class="card-body">
        <table class="table table-hover" id="data_table">
            <thead>
            <tr>
                <th>Names</th>
                <th>Message</th>
                <th>Response</th>
                <th>Date</th>
                <th>Reply</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (fetch_feedbacks() as $_feedback): ?>
                <tr>
                    <td><?= $_feedback['first_name'].' '.$_feedback['last_name'] ?></td>
                    <td><?= $_feedback['message'] ?></td>
                    <td <?php if($_feedback['response'] == 'no_response') echo 'class="text-danger"' ?>>
                        <?php
                        if ($_feedback['response'] == 'no_response')
                            echo '<i>waiting for response</i>';
                        else
                            echo $_feedback['response']
                        ?>
                    </td>
                    <td><?= $_feedback['date_created'] ?></td>
                    <td>
                        <form action="update_feedback.php" method="post">
                            <input type="hidden" name="update_feedback_id" value="<?= $_feedback['feedback_id']; ?>">
                            <button class="btn btn-link btn-sm " type="submit" name="edit_feedback_btn"><span class="text-success table-icons icon-pencil"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
</section>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>
