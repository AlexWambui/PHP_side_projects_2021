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
                                                <h4 class="modal-title w-100 font-weight-bold">Sell a Book</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="./sell.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="book">Book</label>
                                                        <select name="book" id="book" class="selectpicker form-control"
                                                                data-live-search="true" required>
                                                            <option data-tokens="none_selected">Select Book</option>
                                                            <?= select_books_options() ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="customer_names">Customer's Names</label>
                                                        <input type="text" name="customer_names" id="customer_names"
                                                               class="form-control" placeholder="Customer's Names">
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
                                <th>Book</th>
                                <th>Category</th>
                                <th>Customer's Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all_sales() as $sale):?>
                                <tr>
                                    <td><?= $sale['title'].' (<i>by '.$sale["author"].')</i>' ?></td>
                                    <td><?= $sale['category'] ?></td>
                                    <td><?= $sale['customer_names'] ?></td>
                                    <td><?= $sale['price'] ?></td>
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
                                                    <button class="btn btn-warning btn-sm" name="print_receipt"><span class="icon-print"></span> Print</button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="./sell.php" method="post">
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
</body>
</html>