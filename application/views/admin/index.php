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
                
					
					<li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">25</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/ui/card') ?>">Cards</a></li>
                            <li><a href="<?php echo base_url('admin/ui/panel_well') ?>">Panels and Wells</a></li>
                            <li><a href="<?php echo base_url('admin/ui/panel_block') ?>">Panels With BlockUI</a></li>
                            <li><a href="<?php echo base_url('admin/ui/drag_panel') ?>">Draggable Panel</a></li>
                            <li><a href="<?php echo base_url('admin/ui/dragPortlet') ?>">Draggable Portlet</a></li>
                            <li><a href="<?php echo base_url('admin/ui/buttons') ?>">Buttons</a></li>
                            <li><a href="<?php echo base_url('admin/ui/bootsrap_switch') ?>">Bootstrap Switch</a></li>
                            <li><a href="<?php echo base_url('admin/ui/date_pagination') ?>">Date Paginator</a></li>
                            <li><a href="<?php echo base_url('admin/ui/sweet_alert') ?>">Sweat alert</a></li>
                            <li><a href="<?php echo base_url('admin/ui/typography') ?>">Typography</a></li>
                            <li><a href="<?php echo base_url('admin/ui/grid') ?>">Grid</a></li>
                            <li><a href="<?php echo base_url('admin/ui/tabs') ?>">Tabs</a></li>
                            <li><a href="<?php echo base_url('admin/ui/stylish') ?>">Stylish Tabs</a></li>
                            <li><a href="<?php echo base_url('admin/ui/modals') ?>">Modals</a></li>
                            <li><a href="<?php echo base_url('admin/ui/progressbar') ?>">Progress Bars</a></li>
                            <li><a href="<?php echo base_url('admin/ui/notification') ?>">Notifications</a></li>
                            <li><a href="<?php echo base_url('admin/ui/carousel') ?>">Carousel</a></li>
                            <li><a href="<?php echo base_url('admin/ui/list_media') ?>">List & Media object</a></li>
                            <li><a href="<?php echo base_url('admin/ui/user_card') ?>">User Cards</a></li>
                            <li><a href="<?php echo base_url('admin/ui/timeline') ?>">Timeline</a></li>
                            <li><a href="<?php echo base_url('admin/ui/horizontal_timeline') ?>">Horizontal Timeline</a></li>
                            <li><a href="<?php echo base_url('admin/ui/nestable') ?>">Nesteble</a></li>
                            <li><a href="<?php echo base_url('admin/ui/range_slider') ?>">Range Slider</a></li>
                            <li><a href="<?php echo base_url('admin/ui/ribbon') ?>">Ribbons</a></li>
                            <li><a href="<?php echo base_url('admin/ui/steps') ?>">Steps</a></li>
                        </ul>
                    </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Report Admin <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/report_admin_kriminalitas') ?>">Laporan Kriminalitas</a></li>
                            <li> <a href="<?php echo base_url('admin/report_admin_lostfound') ?>">Laporan Lost & Found</a></li>
                            <li> <a href="<?php echo base_url('admin/report_admin_subscription') ?>">Laporan Subscription</a></li>
                        </ul>
                    </li>	 
					
                    <li> <a href="<?php echo base_url('admin/widget/widget') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>
                    <li> <a href="#" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/icon/font_awesome') ?>">Font awesome</a> </li>
                            <li> <a href="<?php echo base_url('admin/icon/themifyIcon') ?>">Themify Icons</a> </li>
                            <li> <a href="<?php echo base_url('admin/icon/simpleLineIcon') ?>">Simple line Icons</a> </li>
                            <li><a href="<?php echo base_url('admin/icon/lineIcon') ?>">Linea Icons</a></li>
                            <li><a href="<?php echo base_url('admin/icon/weatherIcon') ?>">Weather Icons</a></li>
                        </ul>
                    </li>
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">29</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('admin/page/starter') ?>">Starter Page</a></li>
                            <li><a href="<?php echo base_url('admin/page/blank') ?>">Blank Page</a></li>
                            <li><a href="javascript:void(0)" class="waves-effect">Email Templates
            <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="<?php echo base_url('admin/page/email_basic') ?>">Basic</a></li>
                                    <li><a href="<?php echo base_url('admin/page/email_alert') ?>">Alert</a></li>
                                    <li><a href="<?php echo base_url('admin/page/email_billing') ?>">Billing</a></li>
                                    <li><a href="<?php echo base_url('admin/page/reset_password') ?>">Reset Password</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url('admin/page/lightBox') ?>">Lightbox Popup</a></li>
                            <li><a href="<?php echo base_url('admin/page/treeview') ?>">Treeview</a></li>
                            <li><a href="<?php echo base_url('admin/page/search_result') ?>">Search Result</a></li>
                            <li><a href="<?php echo base_url('admin/page/utility_class') ?>">Utility Classes</a></li>
                            <li><a href="<?php echo base_url('admin/page/custom_scroll') ?>">Custom Scrolls</a></li>
                            <li><a href="<?php echo base_url('admin/page/login_page') ?>">Login Page</a></li>
                            <li><a href="<?php echo base_url('admin/page/second_login') ?>">Login v2</a></li>
                            <li><a href="<?php echo base_url('admin/page/animation') ?>">Animations</a></li>
                            <li><a href="<?php echo base_url('admin/page/profile') ?>">Profile</a></li>
                            <li><a href="<?php echo base_url('admin/page/invoice') ?>">Invoice</a></li>
                            <li><a href="<?php echo base_url('admin/page/faq') ?>">FAQ</a></li>
                            <li><a href="<?php echo base_url('admin/page/gallery') ?>">Gallery</a></li>
                            <li><a href="<?php echo base_url('admin/page/pricing') ?>">Pricing</a></li>
                            <li><a href="<?php echo base_url('admin/page/register') ?>">Register</a></li>
                            <li><a href="<?php echo base_url('admin/page/second_register') ?>">Register v2</a></li>
                            <li><a href="<?php echo base_url('admin/page/step_registration') ?>">3 Step Registration</a></li>
                            <li><a href="<?php echo base_url('admin/page/recover_password') ?>">Recover Password</a></li>
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
