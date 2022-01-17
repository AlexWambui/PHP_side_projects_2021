<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_sale'])) add_sale();
if (isset($_POST['delete_sale'])) delete_sale();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <link rel="stylesheet" href="../assets/css/selectize.css">
    <script src="../assets/js/selectize.js"></script>
    <title>Sales</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card text-dark">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Sales Today (<?= count_sales_today() ?>)</h5>
                            </div>
                            <div class="col text-right">
                                <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Make a Sale</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="./sales.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="meal_id">Meal</label>
                                                        <select name="meal_id" id="meal_id" class="selectpicker form-control"
                                                                data-live-search="true" required>
                                                            <option data-tokens="none_selected">Select Meal</option>
                                                            <?= select_meal_options() ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" name="quantity" id="quantity"
                                                               class="form-control" placeholder="Quantity"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="payment_method">Payment Method</label>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="cash" name="payment_method" value="1">
                                                            <label class="custom-control-label" for="cash">Cash</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="mpesa" name="payment_method" value="2">
                                                            <label class="custom-control-label" for="mpesa">Mpesa</label>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="add_sale" id="add_sale" class="btn btn-default">
                                                    Save
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                                   data-target="#modalAddPayment">New Sale</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Meal</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Payment Method</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all_sales_today() as $sale):?>
                                <tr>
                                    <td><?= $sale['meal_name'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['quantity'] ?></td>
                                    <td>
                                        <?php
                                        if($sale['payment_method'] == 1) echo 'Cash';
                                        elseif($sale['payment_method'] == 2) echo 'MPesa';
                                        ?>
                                    </td>
                                    <td><?= $sale['price'] * $sale['quantity'] ?></td>
                                    <td>
                                        <div class="action_buttons_wrapper">
                                            <div class="action_button">
                                                <form action="update_sale.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['sale_id'] ?>">
                                                    <button class="btn btn-success btn-sm" name="sell_book"><span class="icon-pencil"></span> Edit</button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="receipt.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['sale_id'] ?>">
                                                    <button class="btn btn-warning btn-sm" name="print_receipt"><span class="icon-print"></span> Receipt</button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="sales.php" method="post">
                                                    <input type="hidden" name="delete_id" value="<?= $sale['sale_id'] ?>">
                                                    <button class="btn btn-danger btn-sm" name="delete_sale"><span class="icon-trash"></span> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>