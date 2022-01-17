<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Vehicles</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h5>Vehicles</h5>
                        </div>
                        <div class="col text-right">
                            <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Vehicle</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form action="include/functions.php" method="post" autocomplete="off">
                                                <div class="form-group mb-2">
                                                    <label for="registration_number">Registration Number</label>
                                                    <input type="text" name="registration_number" is="registration_number" class="form-control validate" placeholder="Registration Number e.g. KDB 445Y" required autofocus>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="arrival_time">Arrival Time</label>
                                                    <input type="time" name="arrival_time" id="arrival_time" class="form-control validate" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="departure_time">Departure Time</label>
                                                    <input type="time" name="departure_time" id="departure_time" class="form-control validate">
                                                </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="submit" name="save_vehicle_details" id="save_vehicle_details" class="btn btn-default">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal" data-target="#modalAddPayment">New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="data_table">
                        <thead>
                        <tr>
                            <th>Reg. No</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Rate (Kshs)</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach(today_vehicles_as_array() as $vehicle): ?>
                        <tr>
                            <td><?= $vehicle['registration_number'] ?></td>
                            <td><?= $vehicle['arrival_time'] ?></td>
                            <td><?= $vehicle['departure_time'] ?></td>
                            <td>100/hour</td>
                            <td><?= round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2) ?> shs</td>
                            <td>
                                <div class="action_container">
                                    <div class="action">
                                        <form action="update_vehicle.php">
                                            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                                            <button class="btn btn-success btn-sm" name="update_vehicle"><span class="icon-pencil"></span> Edit</button>
                                        </form>
                                    </div>
                                    <div class="action">
                                        <form action="include/functions.php" method="post">
                                            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                                            <button class="btn btn-danger btn-sm" name="delete_vehicle_details"><span class="icon-trash"></span> Delete</button>
                                        </form>
                                    </div>
                                    <div class="action">
                                        <form action="parking_receipt.php">
                                            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                                            <button class="btn btn-warning btn-sm" name="generate_receipt"><span class="icon-print2"></span> Receipt</button>
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
</main>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>
