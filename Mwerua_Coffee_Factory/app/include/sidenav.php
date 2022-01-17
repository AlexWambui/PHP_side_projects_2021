<section class="side_navbar">
    <ul class="nav_links">
        <li class="nav_item nav_item_bordered"><a href="welcome_page.php"><span class="side_nav_icons icon-dashboard"></span> Dashboard</a></li>
        <?php if($_SESSION['user_level'] == 2 ): ?>
        <li class="nav_item nav_item_bordered"><a href="users.php"><span class="side_nav_icons icon-users"></span> Users</a></li>
        <?php endif; ?>
        <li class="nav_item nav_item_bordered"><a href="Payments.php"><span class="side_nav_icons icon-money"></span> Payments</a></li>
        <li class="nav_item nav_item_bordered"><a href="feedbacks.php"><span class="side_nav_icons icon-message"></span> Feedbacks</a></li>
        <?php if($_SESSION['user_level'] == 2 ): ?>
        <li class="nav_item nav_item_bordered"><a href="reports.php"><span class="side_nav_icons icon-folder-open"></span> Reports</a></li>
        <?php endif; ?>
        <div class="bottom_link">
            <li class="nav_item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?= $_SESSION['first_name'] ?>
                </a>
                <ul class="dropdown-menu">
                    <a class="dropdown-item text-dark" href="profile_page.php">Your Profile</a>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item text-dark" href="include/logout.php">Sign out</a>
                </ul>
            </li>
        </div>
    </ul>
</section>

<script>
    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>