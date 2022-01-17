<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_purchase'])) add_purchase();
if (isset($_POST['delete_purchase'])) delete_purchase();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Purchases</title>
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
                                <h5>Purchases</h5>
                            </div>
                            <div class="col text-right">
                                <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Make a Purchase</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="purchases.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="farmers_names">Farmer's Names</label>
                                                        <input type="text" name="farmers_names" id="farmers_names"
                                                               class="form-control" placeholder="Farmer's Names"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email_address">Email Address</label>
                                                        <input type="email" name="email_address" id="email_address"
                                                               class="form-control" placeholder="Email Address"
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
                                                <button type="submit" name="add_purchase" id="add_purchase" class="btn btn-default">
                                                    Save
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                                   data-target="#modalAddPayment">New Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Farmer's Names</th>
                                <th>Email Address</th>
                                <th>Amount in Kgs</th>
                                <th>Cost per Kgs</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all('purchases') as $purchase):?>
                            <tr>
                                <td><?= $purchase['farmers_names'] ?></td>
                                <td><?= $purchase['email_address'] ?></td>
                                <td><?= $purchase['amount_in_kgs'] ?></td>
                                <td><?= $purchase['cost_per_kg'] ?></td>
                                <td><?= $purchase['amount_in_kgs'] * $purchase['cost_per_kg'] ?></td>
                                <td>
                                    <div class="action_buttons_wrapper">
                                        <div class="action_button">
                                            <form action="update_purchase.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $purchase['id'] ?>">
                                                <button class="btn btn-success btn-sm" name="edit_purchase"><span class="icon-pencil"></span> Edit</button>
                                            </form>
                                        </div>
                                        <div class="action_button">
                                            <form action="purchases.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $purchase['id'] ?>">
                                                <button class="btn btn-danger btn-sm" name="delete_purchase"><span class="icon-trash"></span> Delete</button>
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