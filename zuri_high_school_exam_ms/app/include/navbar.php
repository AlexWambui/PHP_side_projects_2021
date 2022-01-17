<aside>
    <div class="app_name text-center">
        <h1>ZURI High</h1>
    </div>
    <div class="nav_links">
        <ul>
            <li><a href="welcome_page.php"><span class="icon-dashboard"></span> Dashboard</a></li>
            <?php if($_SESSION['user_level'] != 1): ?>
            <li><a href="users.php"><span class="icon-users"></span> Users</a></li>
            <li><a href="classes.php"><span class="icon-building-o"></span> Classes</a></li>
            <li><a href="subjects.php"><span class="icon-book"></span> Subjects</a></li>
            <?php endif; ?>
            <li><a href="students.php"><span class="icon-user"></span> Students</a></li>
            <li><a href="results.php"><span class="icon-graduation-cap"></span> Results</a></li>
<!--            <li><a href="report_form.php"><span class="icon-newspaper-o"></span> Report Form</a></li>-->
        </ul>
    </div>
    <div class="account">
        <p><?= $_SESSION['first_name'] ?></p>
<!--        <a href="profile.php" class="account_btn">Profile</a>-->
        <form action="include/functions.php" method="post">
            <button type="submit" name="logout_btn" class="account_btn">Logout</button>
        </form>
    </div>
</aside>