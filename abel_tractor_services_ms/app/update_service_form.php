<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Service | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Update Service</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('services') as $service): ?>
                            <form action="include/functions.php" method="post">
                                <input type="hidden" name="update_id" value="<?= $service['id'] ?>">
                                <div class="form-group">
                                    <label for="tractor_name">Tractor Name</label>
                                    <input type="text" name="tractor_name" id="tractor_name" class="form-control" value="<?= $service['tractor_name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="service_name">Service Name</label>
                                    <input type="text" name="service_name" id="service_name" class="form-control" value="<?= $service['service_name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" value="<?= $service['description'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Description</label>
                                    <input type="number" name="price" id="price" class="form-control" value="<?= $service['price'] ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="btn_update_service">Update</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>

