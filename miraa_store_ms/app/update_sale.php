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
                <div class="card">
                    <h5 class="card-header text-center">Update Sale</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('sales') as $sale): ?>
                            <form action="./update_sale.php" method="post">
                                <input type="hidden" name="sale_id" value="<?= $sale['id'] ?>">
                                <div class="form-group">
                                    <label for="farmers_names">Customer's Names</label>
                                    <input type="text" name="customers_names" id="customers_names"
                                           class="form-control" placeholder="Customer's Names" value="<?= $sale['customers_names'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="amount_in_kgs">Amount in Kgs</label>
                                    <input type="number" name="amount_in_kgs" id="amount_in_kgs"
                                           class="form-control" placeholder="Amount in Kgs" step="any"
                                           min="0" value="<?= $sale['amount_in_kgs'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="cost_per_kg">Cost per Kg</label>
                                    <input type="number" name="cost_per_kg" id="cost_per_kg"
                                           class="form-control" placeholder="Cost per Kg" step="any"
                                           min="0" value="<?= $sale['cost_per_kg'] ?>" required>
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

