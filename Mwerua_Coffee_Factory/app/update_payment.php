<?php
include_once "../app/include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "../app/include/head_section.php" ?>
    <title>Update: Payment</title>
</head>
<body>
<?php include_once "../app/include/sidenav.php"?>
<section class="main_content">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-9">
            <div class="card">
                <h5 class="card-header text-center">Update Payment</h5>
                <div class="card-body">
                    <?php foreach (payments() as $payment): ?>
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="update_id" id="update_id" value="<?= $payment['payment_id'] ?>">
                            <div class="form-group mb-2">
                                <label for="id_number">Id Number</label>
                                <select name="id_number" id="id_number" class="form-control" required>
                                    <option value="<?= $payment['user_id'] ?>" disabled><?= $payment['email_address'] ?></option>
                                    <?= update_user_select_options($payment['user_id']) ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="date_collected">Date Collected</label>
                                <input type="date" name="date_collected" id="date_collected" class="form-control validate" min="1990-01-01" max="<?= date('Y-m-d') ?>" value="<?= $payment['date_collected'] ?>" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="amount_in_kgs">Amount in Kgs</label>
                                <input type="number" name="amount_in_kgs" id="amount_in_kgs" class="form-control validate" placeholder="Amount in Kgs" value="<?= $payment['amount_in_kgs'] ?>" required>
                            </div>
                            <div class="form-group d-flex justify-content-around">
                                <button type="submit" name="update_payment" id="update_payment" class="btn btn-outline-success">Update</button>
                                <button type="button" class="btn btn-outline-danger">Cancel</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
