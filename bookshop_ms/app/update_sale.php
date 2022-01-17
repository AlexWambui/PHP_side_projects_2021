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
                        <?php foreach(fetch_this_sale() as $sale): ?>
                            <form action="./update_sale.php" method="post">
                                <input type="hidden" name="sale_id" value="<?= $sale['sale_id'] ?>">
                                <div class="form-group">
                                    <label for="book">Book</label>
                                    <select name="book" id="book" class="selectpicker form-control"
                                            data-live-search="true" required>
                                        <option value="<?= $sale['book_id'] ?>"><?= $sale['title'].' <i>(by '.$sale['author'].'</i>)' ?></option>
                                        <?= select_books_options() ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer name" value="<?= $sale['customer_names'] ?>">
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

