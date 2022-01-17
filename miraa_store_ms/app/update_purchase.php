<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_purchase'])) update_purchase();
?>
<!doctype html>
<html lang="en"a>
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Purchase | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Update Purchase</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('purchases') as $purchase): ?>
                            <form action="update_purchase.php" method="post">
                                <input type="hidden" name="update_id" value="<?= $purchase['id'] ?>">
                                <div class="form-group">
                                    <label for="farmers_names">Farmer's Names</label>
                                    <input type="text" name="farmers_names" id="farmers_names"
                                           class="form-control" placeholder="Farmer's Names" value="<?= $purchase['farmers_names'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" name="email_address" id="email_address"
                                           class="form-control" placeholder="Email Address" value="<?= $purchase['email_address'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="amount_in_kgs">Amount in Kgs</label>
                                    <input type="number" name="amount_in_kgs" id="amount_in_kgs"
                                           class="form-control" placeholder="Amount in Kgs" step="any"
                                           min="0" value="<?= $purchase['amount_in_kgs'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="cost_per_kg">Cost per Kg</label>
                                    <input type="number" name="cost_per_kg" id="cost_per_kg"
                                           class="form-control" placeholder="Cost per Kg" step="any"
                                           min="0" value="<?= $purchase['cost_per_kg'] ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_purchase">Update</button>
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

