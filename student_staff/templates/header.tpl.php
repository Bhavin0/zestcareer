<header id="header">
    <button id="mobileMenuBtn"></button>
    <span class="logo pull-left">
        <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="img-responsive">
    </span>

    <nav>
        <ul class="nav pull-right">
            <li class="dropdown pull-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-user fa-2x" style="color:#fff;"></i>
                    <span class="user-name">
                        <span class="hidden-xs" style="color:#fff;">
                            &nbsp;<?php echo $_SESSION['eschools']['user_name']; ?>
                        </span>
                    </span>
                </a>

                <ul class="dropdown-menu hold-on-click">
                    <li>
                        <a href="?pid=9"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                    

                </ul>

            </li>
        </ul>
    </nav>

</header>

    <section id="middle">
    <?php
        $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
        $res_year = getarrayassoc($sel_year);
    ?>
    <header id="page-header">

        <ol class="breadcrumb">

            <li>
                <b>Academic Year: </b>
                <?php echo displaydate($res_year['fi_ac_startdate']);?>&nbsp;to&nbsp;<?php echo displaydate($res_year['fi_ac_enddate']);?>
            </li>

        </ol>

    </header>

    <div id="content" class="dashboard padding-10">