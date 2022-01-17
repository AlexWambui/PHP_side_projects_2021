<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Payments</title>
</head>
<body>
<?php include_once "include/sidenav.php" ?>
<section class="main_content">
    <div class="card">
        <div class="card-header _card_header">
            <div class="row">
                <div class="col">
                    <h6>Payments</h6>
                </div>
                <div class="col text-right text-dark">
                    <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">Payments</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    <form action="include/functions.php" method="post">
                                        <div class="form-group mb-2">
                                            <label for="users_id">Email Address</label>
                                            <select name="users_id" id="users_id" class="selectpicker form-control"
                                                    data-live-search="true" required>
                                                <option data-tokens="none_selected">Select Email</option>
                                                <?= select_user_select_option() ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="date_collected">Date Collected</label>
                                            <input type="date" name="date_collected" id="date_collected"
                                                   class="form-control validate" min="1990-01-01"
                                                   max="<?= date('Y-m-d') ?>" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="amount_in_kgs">Amount in Kgs</label>
                                            <input type="number" name="amount_in_kgs" id="amount_in_kgs"
                                                   class="form-control validate" placeholder="Amount in Kgs" required>
                                        </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" name="save_payment" id="save_payment" class="btn btn-default">
                                        Save
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <?php if ($_SESSION['user_level'] == 2): ?>
                        <div class="text-right">
                            <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                               data-target="#modalAddPayment">New</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_level'] == 1): ?>
                        <div class="text-right">
                            <p class="text-light">Earnings: Sh. <?= calc_user_earnings() ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if ($_SESSION['user_level'] == 2): ?>
                <table class="table table-hover" id="data_table">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Date Collected</th>
                        <th>Amount in Kgs</th>
                        <th>Earnings</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (fetch_payments() as $payment): ?>
                        <tr>
                            <td><?= $payment['first_name'] . ' ' . $payment['last_name'] ?></td>
                            <td><?= $payment['date_collected'] ?></td>
                            <td><?= $payment['amount_in_kgs'] ?></td>
                            <td><?= $payment['amount_in_kgs'] * 100 ?></td>
                            <td <?php if($payment['payment_status'] == '-') echo 'class="text-danger"' ?>><?= $payment['payment_status'] ?></td>
                            <td>
                                <div class="row">
                                    <div class="col justify-content-center">
                                        <!--                                    <a href="" class="" data-toggle="modal" data-target="#modalUpdatePayment"><span class="text-success table_icons icon-pencil"></span></a>-->
                                        <form action="update_payment.php" method="post">
                                            <input type="hidden" name="update_id"
                                                   value="<?= $payment['payment_id']; ?>">
                                            <button class="btn btn-link btn-sm " type="submit" name="edit_payment"><span
                                                        class="text-success table-icons icon-pencil"></span></button>
                                        </form>
                                    </div>
                                    |
                                    <div class="col justify-content-center">
                                        <form action="include/functions.php" method="post" class="form-inline">
                                            <input type="hidden" name="delete_payment_id" id="delete_payment_id"
                                                   value="<?= $payment['payment_id'] ?>">
                                            <button type="submit" name="delete_payment" class="btn btn-sm"><span
                                                        class="text-danger table_icons icon-trash"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <?php if ($_SESSION['user_level'] == 1): ?>
                <table class="table table-hover" id="data_table">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Date Collected</th>
                        <th>Amount in Kgs</th>
                        <th>Earned</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (fetch_user_payments() as $user_payment): ?>
                        <tr>
                            <td><?= $user_payment['first_name'] . ' ' . $user_payment['last_name'] ?></td>
                            <td><?= $user_payment['date_collected'] ?></td>
                            <td><?= $user_payment['amount_in_kgs'] ?></td>
                            <td><?= $user_payment['amount_in_kgs'] * 100 ?></td>
                            <td><?= $user_payment['payment_status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</section>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>

</body>
</html>
