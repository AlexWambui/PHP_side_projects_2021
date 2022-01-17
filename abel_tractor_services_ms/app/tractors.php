<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['new_request'])) add_request();
if (isset($_POST['add_service'])) add_service();
if (isset($_POST['delete_service'])) delete_service();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Tractors | Services</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row">
            <?php
            if ($_SESSION['user_level'] == 1)
            {
                foreach (fetch_all('services') as $service)
                {
                    ?>
                        <div class="col-3 mt-3 services_wrapper">
                            <div class="service_container">
                                <div class="service_container_image d-flex justify-content-center">
                                    <img src="<?=$service['tractor_image']?>" class="db_images" alt="">
                                </div>
                                <h5><?= $service['tractor_name'] ?></h5>
                                <h5><?= $service['service_name']; ?></h5>
                                <p><?= $service['description']; ?></p>
                                <p>Price: Kshs. <?= $service['price'] ?>/=</p>
                                <form action="tractors.php" method="post">
                                    <div class="form-group mb-2">
                                        <input type="hidden" name="service_id" value="<?= $service['id']; ?>">
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="date_required">Date Required</label>
                                        <input type="date" name="date_required" id="date_required"
                                               class="form-control validate" min="<?= date('Y-m-d') ?>"
                                               required>
                                    </div>
                                    <button type="submit" name="new_request" id="new_request"
                                            class="btn btn-success">Request Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php
                }
            }
            ?>

            <?php if ($_SESSION['user_level'] == 2): ?>
                <div class="col-10 mt-3">
                    <?= alert() ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?= count_all('services') ?> service(s)</h5>
                                </div>
                                <div class="col text-right">
                                    <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">Services</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <form action="tractors.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                        <div class="form-group">
                                                            <label for="tractor_name">Tractor Name</label>
                                                            <input type="text" name="tractor_name" id="tractor_name"
                                                                   class="form-control validate" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="service_name">Service Name</label>
                                                            <input type="text" name="service_name" id="service_name"
                                                                   class="form-control validate"
                                                                   placeholder="Service Name"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <input type="text" name="description" id="description"
                                                                   class="form-control validate"
                                                                   placeholder="Description"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" name="price" id="price"
                                                                   class="form-control validate" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tractor_image">Tractor Image</label>
                                                            <input type="file" accept="image/*" class="form-control-file border" name="tractor_image" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button type="submit" name="add_service" id="add_service"
                                                            class="btn btn-default">Save
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                                       data-target="#modalAddPayment">New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="data_table">
                                <thead>
                                <tr>
                                    <th>Tractor Name</th>
                                    <th>Service Name</th>
                                    <th>Description</th>
                                    <th>Tractor Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (fetch_all('services') as $service): ?>
                                    <tr>
                                        <td><?= $service['tractor_name'] ?></td>
                                        <td><?= $service['service_name'] ?></td>
                                        <td><?= $service['description'] ?></td>
                                        <td><img src="<?=$service['tractor_image']?>" width="50" height="50" alt="tractor_image"></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <div class="action_buttons">
                                                    <form action="update_service_form.php" method="post">
                                                        <input type="hidden" name="update_id"
                                                               value="<?= $service['id'] ?>">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                                name="update_form"><span class="icon-pencil"></span> Update
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="action_buttons">
                                                    <form action="tractors.php" method="post">
                                                        <input type="hidden" name="delete_id"
                                                               value="<?= $service['id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                name="delete_service"><span class="icon-trash"></span> Delete
                                                        </button>
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
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>

