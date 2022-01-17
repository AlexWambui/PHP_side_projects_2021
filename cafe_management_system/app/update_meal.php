<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_meal'])) update_meal();
?>
<!doctype html>
<html lang="en"a>
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Meal | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card text-dark">
                    <h5 class="card-header text-center">Update Meal</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('meals') as $meal): ?>
                            <form action="./update_meal.php" method="post">
                                <input type="hidden" name="update_id" value="<?= $meal['id'] ?>">
                                <div class="form-group">
                                    <label for="category">Meal Category</label>
                                    <select name="category" id="category" class="selectpicker form-control"
                                            data-live-search="true" required>
                                        <option data-tokens="<?= $meal['category'] ?>"><?= $meal['category'] ?></option>
                                        <option value="breakfast">Breakfast</option>
                                        <option value="lunch">Lunch</option>
                                        <option value="supper">Supper</option>
                                        <option value="soft_drink">Soft Drink</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="meal_name">Meal Name</label>
                                    <input type="text" name="meal_name" id="meal_name"
                                           class="form-control" placeholder="(e.g) Rice" value="<?= $meal['meal_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price"
                                           class="form-control" placeholder="Price in Kshs." step="any"
                                           min="0" value="<?= $meal['price'] ?>"
                                           required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_meal">Update</button>
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

