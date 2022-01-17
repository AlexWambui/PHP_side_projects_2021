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
    <title>Sell</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Sales</h5>
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
                                                        <label for="farmers_names">Customer's Names</label>
                                                        <input type="text" name="customers_names" id="customers_names"
                                                               class="form-control" placeholder="Customer's Names"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount_in_kgs">Amount in Kgs</label>
                                                        <input type="number" name="amount_in_kgs" id="amount_in_kgs"
                                                               class="form-control" placeholder="Amount in Kgs" step="any"
                                                               min="0"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cost_per_kg">Cost per Kg</label>
                                                        <input type="number" name="cost_per_kg" id="cost_per_kg"
                                                               class="form-control" placeholder="Cost per Kg" step="any"
                                                               min="0" required>
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
                                <th>Customer's Names</th>
                                <th>Amount in Kgs</th>
                                <th>Cost per Kg</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all('sales') as $sale):?>
                                <tr>
                                    <td><?= $sale['customers_names'] ?></td>
                                    <td><?= $sale['amount_in_kgs'] ?></td>
                                    <td><?= $sale['cost_per_kg'] ?></td>
                                    <td><?= $sale['amount_in_kgs'] * $sale['cost_per_kg'] ?></td>
                                    <td>
                                        <div class="action_buttons_wrapper">
                                            <div class="action_button">
                                                <form action="update_sale.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['id'] ?>">
                                                    <button class="btn btn-success btn-sm" name="sell_book"><span class="icon-pencil"></span> Edit</button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="receipt.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['id'] ?>">
                                                    <button class="btn btn-warning btn-sm" name="print_receipt"><span class="icon-print"></span> Receipt</button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="sales.php" method="post">
                                                    <input type="hidden" name="delete_id" value="<?= $sale['id'] ?>">
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
</body>
</html>