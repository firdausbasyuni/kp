<header>
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav bg-light" style="height:60px;">
        <!-- SideNav slide-out button -->

        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
            <a class="navbar-brand" href="<?php echo site_url('AdminController/index'); ?>"><img src="http://sharedvis.co.id/assets/front/images/corporate/client/telkominfra.png" style="height:40px;"></a>
        </div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="https://www.freepngimg.com/thumb/man/10-man-png-image.png" class="user-image" alt="User Image" style="width:36px; margin-top:-4px; margin-right:8px;">
                    <span class="hidden-xs" style="color:black;"><?php echo $this->session->userdata('nama'); ?></span>
                </a>
                <ul class="dropdown-menu" style="text-align:center;">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="https://www.freepngimg.com/thumb/man/10-man-png-image.png" class="img-circle" alt="User Image" style="width:32px;">
                        <p style="text-decoration:no;">
                            <?php echo $this->session->userdata('nama'); ?><br>Admin
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="<?php echo site_url('logincontroller/logout') ?>" class="btn btn-secondary btn-flat">Log out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php $this->load->view('admintemplate/sidebar') ?>
</header>