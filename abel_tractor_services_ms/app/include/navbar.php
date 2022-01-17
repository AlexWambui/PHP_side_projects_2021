<header class="container-fluid">
    <div class="row">
        <div class="col app_name">
            <p>ABEL_TRACTORS</p>
        </div>
        <div class="col app_features">
            <a href="welcome_page.php">Home</a>
            <a href="tractors.php">Tractors</a>
            <a href="requests.php">Requests</a>
<!--            <a href="reports.php">Reports</a>-->
        </div>
        <div class="col profile_details">
            <div class="btn-group dropdown" style="float:right;">
                <button type="button" class="btn btn-dark btn-sm dropbtn dropdown-toggle">
                    <?= $_SESSION['first_name'] ?>
                </button>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="profile_page.php">profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="include/functions.php" method="post">
                        <div class="form-group">
                            <button type="submit" name="logout" class="dropdown-item">logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>