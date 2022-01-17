<?php
include_once "../app/include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Feedback</title>
</head>
<body>
<?php include_once "../app/include/sidenav.php"?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <?php foreach (reply_to_feedback() as $feedback): ?>
            <div class="card feedback_form">
                <div class="card-header _card_header">
                    <p class="text-center"><?= $feedback['first_name'].' '.$feedback['last_name'] ?></p>
                </div>
                <div class="card-body">
                        <p class="float-right feedback_message"><?= $feedback['message'] ?> <span class="float-right"><i><?= $feedback['date_created'] ?></i></span></p>
<!--                        <p class="float-left feedback_response">-->
<!--                            --><?php
//                            if($feedback['response'] == 'no_response')
//                                echo '<i>Wait for a reply...</i>😉';
//                            else
//                                echo $feedback['response'];
//                            ?>
<!--                            <span class="float-right"><i>--><?//= $feedback['date_created'] ?><!--</i></span></p>-->
                </div>
                <div class="card-footer _card_header">
                    <form action="include/functions.php" method="post">
                        <input type="hidden" name="update_feedback_id" value="<?= $feedback['feedback_id'] ?>">
                        <?php if ($feedback['response'] == 'no_response'): ?>
                        <div class="row">
                            <div class="col-11">
                                <input type="text" name="response" id="response" class="form-control" placeholder="Your Response" required>
                            </div>
                            <div class="col-1">
                                <button type="submit" name="respond_to_feedback" id="respond_to_feedback" class="btn btn-light"><span class="icon-send2"></span></button>
                            </div>
                        <?php endif; ?>
                        <?php if ($feedback['response'] != 'no_response'): ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="feeback_given" id="feedback_given" class="form-control" placeholder="Feedback Given" required value="<?= $feedback['response'] ?>" readonly>
                            </div>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
</html>
