<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_sale'])) update_sale();
?>
<!doctype html>
<html lang="en"a>
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Sale | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card text-dark">
                    <h5 class="card-header text-center">Update Sale</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_sale() as $sale): ?>
                            <form action="./update_sale.php" method="post" autocomplete="off">
                                <input type="hidden" name="update_id" value="<?= $sale['sale_id'] ?>">
                                <div class="form-group">
                                    <label for="meal_id">Meal</label>
                                    <select name="meal_id" id="meal_id" class="selectpicker form-control"
                                            data-live-search="true" required>
                                        <option value="<?= $sale['meal_id'] ?>"><?= $sale['meal_name'] ?></option>
                                        <?= select_meal_options() ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity"
                                           class="form-control" placeholder="Quantity" value="<?= $sale['quantity'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="cash" name="payment_method" value="1" <?php if($sale['payment_method'] == 1) echo 'checked' ?>>
                                        <label class="custom-control-label" for="cash">Cash</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="mpesa" name="payment_method" value="2" <?php if($sale['payment_method'] == 2) echo 'checked' ?>>
                                        <label class="custom-control-label" for="mpesa">Mpesa</label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_sale">Update</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>

