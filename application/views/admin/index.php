<?php include 'layout/css.php'; ?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper"> 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-grid"></i></a>
                <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/') ?>"><b><img src="<?php echo base_url();?>optimum/logo.png" alt="Codeig" /></b><span class="hidden-xs">Halaman Admin</span></a></div>	
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search<?php echo base_url();?>optimum."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    
                    <li> <a href="<?php echo base_url('admin/dashboard') ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"> Manage User <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/kepala_keamanan') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu">Tambah Kepala Keamanan</span></a></li>
                            <li> <a href="<?php echo base_url('admin/kepala_keamanan/daftar_kepala_keamanan') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Daftar kepala keamanan</span></a></li>
                            <li> <a href="<?php echo base_url('admin/user/daftar_user') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Daftar user</span></a></li>
                        </ul>
                    </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-list-post p-r-10"></i> <span class="hide-menu"> Manage Laporan <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/laporan_lost_found') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Verifikasi Laporan Lost & Found</span></a></li>
                            <li> <a href="<?php echo base_url('admin/laporan_kriminalitas') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu">Verifikasi Laporan Kriminalitas</span></a></li>
                        </ul>
                    </li>

                    <li> <a href="<?php echo base_url('admin/komentar') ?>" class="waves-effect"><i class="fa fa-comment-o p-r-10"></i> <span class="hide-menu">Manage Komentar</span></a> </li>
                

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Report Admin <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/report_admin_kriminalitas') ?>"><i class="ti-list p-r-10"></i><span class="hide-menu">Laporan Kriminalitas</span></a></li>
                            <li> <a href="<?php echo base_url('admin/report_admin_lostfound') ?>"><i class="ti-list p-r-10"></i><span class="hide-menu">Laporan Lost & Found</span></a></li>
                            <li> <a href="<?php echo base_url('admin/report_admin_subscription') ?>"><i class="ti-money p-r-10"></i><span class="hide-menu">Laporan Subscription</span></a></li>
                        </ul>
                    </li>	              
                    <li><a href="<?php echo base_url('auth') ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
       
	   
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard/">Home</a></li>
                            <li class="active"> <?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 	
				
				
				
				
				<!--  row    ->
               <?php echo $main_content; ?>
                <!-- /.row -->
			
            </div>
            <!-- /.container-fluid -->
           <?php include 'layout/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <?php include 'layout/js.php'; ?>
