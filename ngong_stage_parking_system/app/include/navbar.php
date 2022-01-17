<header class="container-fluid">
    <div class="row">
        <div class="col app_name">
            <p>NSPPS</p>
        </div>
        <div class="col app_features">
            <a href="welcome_page.php">home</a>
            <a href="vehicles.php">vehicles</a>
            <a href="reports.php">Reports</a>
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
                        <button type="submit" name="logout"><a class="dropdown-item">logout</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>