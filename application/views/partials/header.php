<link href="styles/bootstrap.min.css" rel="stylesheet" />
<link href="styles/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="styles/font-awesome.css" rel="stylesheet" />
<link href="styles/style.css" rel="stylesheet" />
<link href="styles/style-responsive.css" rel="stylesheet" />
<link href="styles/style-default.css" rel="stylesheet" id="style_color" />

<!-- crop -->
<link href="plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
<!-- crop -->

<!-- redactor editor -->
<link rel="stylesheet" href="plugins/redactor/css/redactor.css">
<!-- redactor editor -->

<!-- Datetime picker -->
<script type="text/javascript" src="plugins/bootstrap-datepicker/css/datepicker.css"></script>
<!-- Datetime picker -->

<div id="header" class="navbar navbar-inverse navbar-fixed-top">
     <!-- BEGIN TOP NAVIGATION BAR -->
     <div class="navbar-inner">
          <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                    <div class="icon-reorder tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <a class="brand" href="javascript:void(0);">
                    <img src="images/logo.png" alt="Metro Lab" />
               </a>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div id="top_menu" class="nav notify-row">
                    <!-- BEGIN NOTIFICATION -->
                    <ul class="nav top-menu">
                         <!-- BEGIN SETTINGS -->
                    </ul>
               </div>
               <!-- END  NOTIFICATION -->
               <div class="top-nav ">
                    <ul class="nav pull-right top-menu" >
                         <!-- BEGIN SUPPORT -->
                         <!-- BEGIN USER LOGIN DROPDOWN -->
                         <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <img src="images/avatar1_small.jpg" alt="">
                                   <span class="username">
                                        <?php
                                          echo isset($this->ion_auth->user()->row()->username) ?
                                                  $this->ion_auth->user()->row()->username : '';
                                        ?>
                                   </span>
                                   <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu extended logout">
                                   <li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-key"></i> Log Out</a></li>
                              </ul>
                         </li>
                         <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                    <!-- END TOP NAVIGATION MENU -->
               </div>
          </div>
     </div>
     <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
     <!-- BEGIN SIDEBAR -->
     <div class="sidebar-scroll">
          <div id="sidebar" class="nav-collapse collapse">


               <!-- END RESPONSIVE QUICK SEARCH FORM -->
               <!-- BEGIN SIDEBAR MENU -->
               <ul class="sidebar-menu">
                    <li class="sub-menu <?php echo ($controller == 'dashboard') ? 'active' : ''; ?>">
                         <a class="" href="<?php echo site_url(); ?>">
                              <i class="icon-dashboard"></i>
                              <span>Dashboard</span>
                         </a>
                    </li>
                    <!-- Product menu -->
                    <li class="sub-menu <?php echo ($controller == 'product') ? 'active' : ''; ?>">
                         <a href="javascript:;" class="">
                              <i class="icon-book"></i>
                              <span>Product</span>
                              <span class="arrow <?php echo ($controller == 'product') ? 'open' : ''; ?>"></span>
                         </a>
                         <ul class="sub">
                              <li class="<?php echo ($method == 'index' || $method == 'list') ? 'active' : ''; ?>"><a href="<?php echo site_url('product'); ?>">
                                        <i class="icon-list-alt"></i> List</a>
                              </li>
                              <li class="<?php echo ($method == 'add') ? 'active' : ''; ?>"><a href="<?php echo site_url('product/add'); ?>">
                                        <i class="icon-edit"></i> Add</a>
                              </li>
                         </ul>
                    </li>
                    <!-- Product menu -->
                    <!-- Settings -->
                    <li class="<?php echo ($controller == 'user' || $controller == 'settings') ? 'active' : ''; ?> sub-menu">
                         <a href="javascript:;" class="">
                              <i class="icon-book"></i>
                              <span>Settings</span>
                              <span class="arrow <?php echo ($controller == 'user') ? 'open' : ''; ?>"></span>
                         </a>
                         <ul class="sub">
                              <li class="<?php echo ($method == 'change_password') ? 'active' : ''; ?>">
                                   <a href="<?php echo site_url('user/change_password'); ?>">
                                        <i class="icon-cogs"></i>Change Password</a>
                              </li>
                              <li class="<?php echo ($method == 'general_settings') ? 'active' : ''; ?>">
                                   <a href="<?php echo site_url('settings/general_settings'); ?>">
                                        <i class="icon-wrench"></i>General Settings</a>
                              </li>
                         </ul>
                    </li>
               </ul>
               <!-- END SIDEBAR MENU -->
          </div>
     </div>
     <div id="main-content">
          <div class="container-fluid">
               <div class="row-fluid">
                    <div class="span12">
                         <h3 class="page-title">
                              <?php echo isset($this->section) ? $this->section : ''; ?>
                         </h3>
                         <ul class="breadcrumb">
                              <li>
                                   <a href="javascript:void(0);">Home</a>
                                   <span class="divider">/</span>
                              </li>
                              <li>
                                   <a href="javascript:void(0);"><?php echo ucfirst($controller); ?></a>
                                   <?php echo ($method != 'index') ? '<span class="divider">/</span>' : ''; ?>
                              </li>
                              <li class="active">
                                   <?php echo ($method != 'index') ? ucfirst($method) : ''; ?>
                              </li>
                         </ul>
                         <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
               </div>