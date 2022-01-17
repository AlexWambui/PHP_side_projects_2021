<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Request | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Update Request</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('requests') as $request): ?>
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="update_id" value="<?= $request['id'] ?>">
                            <div class="form-group">
                                <label for="date_required">Date Required</label>
                                <input type="date" name="date_required" id="date_required"  class="form-control"
                                       value="<?= $request['date_required'] ?>" min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" name="btn_update_request">Update</button>
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

