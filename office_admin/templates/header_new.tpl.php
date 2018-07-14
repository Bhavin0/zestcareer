<header id="header">

        <button id="mobileMenuBtn"></button>
    
        <span class="logo pull-left">
            <img src="../assets/images/logo.png" alt="admin panel" height="35" />
        </span>

        <nav>
            <ul class="nav pull-right">

                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img class="user-avatar" alt="" src="includes/assets/images/noavatar.jpg" height="34" /> 
                        <span class="user-name">
                            <span class="hidden-xs">
                                <?php echo ucwords($_SESSION['eschools']['admin_user']);?> <i class="fa fa-angle-down"></i>
                            </span>
                        </span>
                    </a>

                    <ul class="dropdown-menu hold-on-click">
                        <li>
                            <a href="?pid=54&action=albumlist">Gallery</a>
                        </li>

                        <li>
                            <a href="download.php?document=admin_userguide.pdf"> User Guide</a>
                        </li>

                        <li>
                            <a href="?pid=41&action=change_password"><i class="fa fa-cogs"></i> Change Password</a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="?pid=54&action=albumlist">Album List</a>
                        </li>

                        <li>
                            <a href="?pid=10"><i class="fa fa-power-off"></i> Log Out</a>
                        </li>

                    </ul>

                </li>
            </ul>
        </nav>

</header>