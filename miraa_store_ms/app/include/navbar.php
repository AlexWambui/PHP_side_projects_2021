<aside>
    <div class="app_name text-center">
        <h1>Miraa Store MS</h1>
    </div>
    <div class="nav_links">
        <ul>
            <li><a href="welcome_page.php"><span class="icon-dashboard"></span> Dashboard</a></li>
            <li><a href="purchases.php"><span class="icon-shopping-basket"></span> Purchases</a></li>
<!--            <li><a href="stock.php"><span class="icon-shopping-cart"></span> Stock</a></li>-->
            <li><a href="sales.php"><span class="icon-attach_money"></span> Sales</a></li>
<!--            <li><a href="reports.php"><span class="icon-files-o"></span> Reports</a></li>-->
        </ul>
    </div>
    <div class="account">
        <p><?= $_SESSION['first_name'] ?></p>
        <a href="profile.php" class="account_btn">Profile</a>
        <form action="include/functions.php" method="post">
            <button type="submit" name="logout_btn" class="account_btn">Logout</button>
        </form>
    </div>
</aside>