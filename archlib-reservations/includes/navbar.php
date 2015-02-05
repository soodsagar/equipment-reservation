<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://www.njit.edu" ><img src="img/njit_logo.png" style="height: 90%; margin-top: 6px;"> </a>
    </div>
    <div class="pull-right text-white" style="margin: 15px 20px 0px 0px">
        Barbara and Leonard Littman Architecture Library
    </div>
    <!-- /.navbar-header -->

</nav>
<!-- /.navbar-static-top -->

<nav class="navbar-default navbar-static-side" role="navigation" style="border-bottom: 0px;">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="index.php" id="index-navbar"><i class="fa fa-2x fa-calendar"></i>Reserve An Item</a>
            </li>
            <li>
                <a href="http://archlib.njit.edu" id="archlib-navbar" target="_blank"><i class="fa fa-2x fa-book fa-fw"></i> Littman Architecture Library </a>
            </li>
            <li>
                <a href="policy.php" id="policy-navbar"><i class="fa fa-2x fa-file-text-o fa-fw"></i> Reservation Policy</a>
            </li>
            <li>
                <a href="login.php" id="staff-navbar"  ><i class="fa fa-2x fa-user fa-fw"></i> Staff Login</a>


            </li>
            <ul class="nav nav-second-level collapse in" id="admin-links" style='display:none'>
                <li>
                    <a style="background: #030320;" href="admin.php">&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> Pending Requests </a>
                </li>
                <li>
                    <a style="background: #030320;" href="accepted.php?start=<?php echo date("Y-m-d"); ?>&end=<?php echo date("Y-m-d"); ?>">&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> Accepted Requests</a>
                </li>
                <li>
                    <a style="background: #030320;" href="eqp.php">&nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-chevron-right'></i> Equipment Management</a>
                </li>

            </ul>

        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->
