<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_meal'])) add_meal();
if (isset($_POST['delete_meal'])) delete_meal();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Meals</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <?= alert() ?>
        <div class="meal_button text-right">
            <div class="modal fade text-dark" id="modalAddMeal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Add a Meal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <form action="./meals.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group">
                                    <label for="category">Meal Category</label>
                                    <select name="category" id="category" class="selectpicker form-control"
                                            data-live-search="true" required>
                                        <option data-tokens="none_selected">Select Category</option>
                                        <option value="breakfast">Breakfast</option>
                                        <option value="lunch">Lunch</option>
                                        <option value="supper">Supper</option>
                                        <option value="soft_drink">Soft Drink</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="meal_name">Meal Name</label>
                                    <input type="text" name="meal_name" id="meal_name"
                                           class="form-control" placeholder="(e.g) Rice">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price"
                                           class="form-control" placeholder="Price in Kshs." step="any"
                                           min="0"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="food_image">Food Image</label>
                                    <input type="file" accept="image/*" class="form-control-file border"
                                           name="food_image" required>
                                </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="add_meal" id="add_meal" class="btn btn-default">
                                Save
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="" class="btn btn-success btn-rounded" data-toggle="modal"
               data-target="#modalAddMeal">New Meal</a>
        </div>
        <div class="container meals">
            <div class="row">
                <div class="col">
                    <h5>Breakfast</h5>
                    <div class="row">
                        <?php foreach(fetch_category('breakfast') as $meal): ?>
                        <div class="col">
                            <div class="meal_card">
                                <div class="meal_card_header">
                                    <img src="<?= $meal['picture_of_meal'] ?>" alt="meal image" class="meal_card_header">
                                </div>
                                <div class="meal_card_body">
                                    <h1><?= $meal['meal_name'] ?></h1>
                                    <p>Price: <?= $meal['price'] ?> /=</p>
                                </div>
                                <div class="meal_card_footer">
                                    <div class="action_button">
                                        <form action="./update_meal.php" method="post">
                                            <input type="hidden" name="update_id" value="<?= $meal['id'] ?>">
                                            <button type="submit" name="update" class="custom_btn">Update</button>
                                        </form>
                                    </div>
                                    <div class="action_button">
                                        <form action="./meals.php" method="post">
                                            <input type="hidden" name="delete_id" value="<?= $meal['id'] ?>">
                                            <button type="submit" name="delete_meal" class="btn btn-danger btn-sm"><span class="icon-trash"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <h5>Lunch</h5>
                    <div class="row">
                        <?php foreach(fetch_category('lunch') as $meal): ?>
                            <div class="col">
                                <div class="meal_card">
                                    <div class="meal_card_header">
                                        <img src="<?= $meal['picture_of_meal'] ?>" alt="meal image" class="meal_card_header">
                                    </div>
                                    <div class="meal_card_body">
                                        <h1><?= $meal['meal_name'] ?></h1>
                                        <p>Price: <?= $meal['price'] ?> /=</p>
                                    </div>
                                    <div class="meal_card_footer text-center">
                                        <div class="action_button">
                                            <form action="./update_meal.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="update" class="custom_btn">Update</button>
                                            </form>
                                        </div>
                                        <div class="action_button">
                                            <form action="./meals.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="delete_meal" class="btn btn-danger btn-sm"><span class="icon-trash"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <h5>Supper</h5>
                    <div class="row">
                        <?php foreach(fetch_category('supper') as $meal): ?>
                            <div class="col">
                                <div class="meal_card">
                                    <div class="meal_card_header">
                                        <img src="<?= $meal['picture_of_meal'] ?>" alt="meal image" class="meal_card_header">
                                    </div>
                                    <div class="meal_card_body">
                                        <h1><?= $meal['meal_name'] ?></h1>
                                        <p>Price: <?= $meal['price'] ?> /=</p>
                                    </div>
                                    <div class="meal_card_footer text-center">
                                        <div class="action_button">
                                            <form action="./update_meal.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="update" class="custom_btn">Update</button>
                                            </form>
                                        </div>
                                        <div class="action_button">
                                            <form action="./meals.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="delete_meal" class="btn btn-danger btn-sm"><span class="icon-trash"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <h5>Soft Drinks</h5>
                    <div class="row">
                        <?php foreach(fetch_category('soft_drink') as $meal): ?>
                            <div class="col">
                                <div class="meal_card">
                                    <div class="meal_card_header">
                                        <img src="<?= $meal['picture_of_meal'] ?>" alt="meal image" class="meal_card_header">
                                    </div>
                                    <div class="meal_card_body">
                                        <h1><?= $meal['meal_name'] ?></h1>
                                        <p>Price: <?= $meal['price'] ?> /=</p>
                                    </div>
                                    <div class="meal_card_footer text-center">
                                        <div class="action_button">
                                            <form action="./update_meal.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="update" class="custom_btn">Update</button>
                                            </form>
                                        </div>
                                        <div class="action_button">
                                            <form action="./meals.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $meal['id'] ?>">
                                                <button type="submit" name="delete_meal" class="btn btn-danger btn-sm"><span class="icon-trash"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>