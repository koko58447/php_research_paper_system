<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->


<!-- Mirrored from radixtouch.in/templates/admin/hotel/source/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Jan 2020 12:35:49 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />

    <!-- icons -->
    <link href="<?php echo roothtml.'lib/assets/plugins/simple-line-icons/simple-line-icons.min.css' ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo roothtml.'lib/assets/plugins/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet"
        type="text/css" />
    <!--bootstrap -->
    <link href="<?php echo roothtml.'lib/assets/plugins/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet"
        type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="<?php echo roothtml.'lib/assets/plugins/material/material.min.css' ?>">
    <link rel="stylesheet" href="<?php echo roothtml.'lib/assets/css/material_style.css' ?>">
    <!-- animation -->
    <link href="<?php echo roothtml.'lib/assets/css/pages/animate_page.css' ?>" rel="stylesheet">
    <!-- Template Styles -->
    <link href="<?php echo roothtml.'lib/assets/css/style.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo roothtml.'lib/assets/css/plugins.min.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo roothtml.'lib/assets/css/responsive.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo roothtml.'lib/assets/css/theme-color.css' ?>" rel="stylesheet" type="text/css" />
    <!-- dropzone -->
    <link href="<?php echo roothtml.'lib/assets/plugins/dropzone/dropzone.css' ?>" rel="stylesheet" media="screen">
    <!-- Date Time item CSS -->
    <link rel="stylesheet" href="<?php echo roothtml.'lib/assets/plugins/flatpicker/flatpickr.min.css' ?>">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo roothtml.'lib/images/ums.jpg' ?>" />
    <!-- summernote -->
    <link href="<?php echo roothtml.'lib/assets/plugins/summernote/summernote.css' ?>" rel="stylesheet">
    <!-- Sweet Alarm -->
    <link href="<?php echo roothtml.'lib/sweet/sweetalert.css' ?>" rel="stylesheet" />
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.js' ?>"></script>
    <!--select2-->
    <link href="<?php echo roothtml.'lib/assets/plugins/select2/css/select2.css' ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo roothtml.'lib/assets/plugins/select2/css/select2-bootstrap.min.css' ?>" rel="stylesheet"
        type="text/css" />
    <title>EFL Myanmar</title>
    <style>
    .loader {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.7;
        -moz-opacity: 0.8;
    }

    .center-load {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: black;
        border-radius: 10px;
        filter: 1;
        -moz-opacity: 1;
    }

    .center-load img {
        height: 128px;
        width: 128px;
    }
    </style>
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color <?php echo ((curlink=='pos.php' || curlink=='pre_service.php' || curlink=='confirm.php') ? 'sidemenu-closed' : '') ?> logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="<?php echo roothtml.'home/home.php' ?>">
                        <span class="logo-default" style="font-size:15px;">EFL Myanmar</span> </a>
                </div>
                <!-- logo end -->
                <ul class="nav navbar-nav navbar-left in">
                    <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
                </ul>
                <form class="search-form-opened" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="query">
                        <span class="input-group-btn search-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- end mobile menu -->
                <!-- start header menu -->
               
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- start notification dropdown -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            
                        </li>
                      
                        <!-- end notification dropdown -->
                        <!-- start message dropdown -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <!-- <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge headerBadgeColor2"> 2 </span>
                            </a> -->
                            <ul class="dropdown-menu animated slideInDown">
                                <li class="external">
                                    <h3><span class="bold">Messages</span></h3>
                                    <span class="notification-label cyan-bgcolor">New 2</span>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="assets/img/user/user2.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                    <span class="from"> Sarah Smith </span>
                                                    <span class="time">Just Now </span>
                                                </span>
                                                <span class="message"> Jatin I found you on LinkedIn... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="assets/img/user/user3.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                    <span class="from"> John Deo </span>
                                                    <span class="time">16 mins </span>
                                                </span>
                                                <span class="message"> Fwd: Important Notice Regarding Your Domain
                                                    Name... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="assets/img/user/user1.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                    <span class="from"> Rajesh </span>
                                                    <span class="time">2 hrs </span>
                                                </span>
                                                <span class="message"> pls take a print of attachments. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="assets/img/user/user8.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                    <span class="from"> Lina Smith </span>
                                                    <span class="time">40 mins </span>
                                                </span>
                                                <span class="message"> Apply for Ortho Surgeon </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="assets/img/user/user5.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                    <span class="from"> Jacob Ryan </span>
                                                    <span class="time">46 mins </span>
                                                </span>
                                                <span class="message"> Request for leave application. </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-menu-footer">
                                        <a href="#"> All Messages </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- end message dropdown -->
                        <!-- start manage user dropdown -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <img alt="" class="img-circle " src="<?php echo roothtml.'upload/staff/teacher/'.$_SESSION['img'] ?>" />
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['name'] ?>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default animated jello">
                                <li>
                                    <a href="<?php echo roothtml.'setting/changepassword.php' ?>">
                                        <i class="icon-lock"></i> Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="btnlogout">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end manage user dropdown -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                data-upgraded=",MaterialButton">
                                <i class="material-icons">settings</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header -->

        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <div class="sidebar-container">
                <div class="sidemenu-container navbar-collapse collapse  fixed-menu">
                    <div id="remove-scroll">
                        <ul class="sidemenu page-header-fixed p-t-20 <?php echo ((curlink=='pos.php' || curlink=='pre_service.php' || curlink=='confirm.php') ? 'sidemenu-closed' : '') ?> data-keep-expanded="false" data-auto-scroll="true"
                            data-slide-speed="200">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <li class="sidebar-user-panel">
                                <div class="user-panel">
                                    <div class="row">
                                        <div class="sidebar-userpic">
                                            <img src="<?php echo roothtml.'upload/staff/teacher/'.$_SESSION['img'] ?>" style="width:50%;" class="img-responsive"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="profile-usertitle">
                                        <div class="sidebar-userpic-name"> <?php echo $_SESSION['name'] ?> </div>
                                        <div class="profile-usertitle-job"> <?php echo $_SESSION['username'] ?> </div>
                                    </div>
                                    <div class="sidebar-userpic-btn">
                                        <a class="tooltips" href="<?php echo roothtml.'setting/changepassword.php' ?>"
                                            data-placement="top" data-original-title="Change Password">
                                            <i class="material-icons">lock</i>
                                        </a>
                                        <a class="tooltips" href="<?php echo roothtml.'home/home.php' ?>" data-placement="top"
                                            data-original-title="Dashoard">
                                            <i class="material-icons">dashboard</i>
                                        </a>
                                        <a class="tooltips" href="#" id="btnlogout" data-placement="top"
                                            data-original-title="Logout">
                                            <i class="material-icons">input</i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item ">

                          

                            <li class="nav-item <?php echo (curlink == 'home.php')?'active' : '' ?>">
                                <a href="<?php echo roothtml.'home/home.php' ?>" class="nav-link nav-toggle"> <i
                                        class="material-icons">dashboard</i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>  
                            <li class="nav-item <?php echo (curlink == 'paper.php')?'active' : '' ?>">
                                <a href="<?php echo roothtml.'paper/paper.php' ?>" class="nav-link nav-toggle"> <i
                                        class="material-icons">note_add</i>
                                    <span class="title">Research Paper</span>
                                </a>
                            </li> 
                             
                            <li class="nav-item <?php echo (curlink == 'paypoint.php' || curlink == 'checkpaper.php' || curlink == 'pointshow.php' || curlink == 'detail.php' )?'active' : '' ?>">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="material-icons">
                                    description
                                    </i><span class="title">Management Paper</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">                                                                      
                                    <li class="nav-item <?php echo (curlink == 'checkpaper.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'paper/checkpaper.php' ?>" class="nav-link ">
                                            <span class="title">Check Paper</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item <?php echo (curlink == 'paypoint.php')?'active' : '' ?>">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Pay Point</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item <?php echo (curlink == 'pointshow.php' || curlink == 'detail.php' )?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'paper/pointshow.php' ?>" class="nav-link ">
                                            <span class="title">Show Point</span>
                                        </a>
                                    </li>                                                                
                                </ul>
                            </li>                        
                                                      
                            <li class="nav-item <?php echo (curlink == 'edit_teacher.php'|| curlink == 'teacher.php'|| curlink == 'publication.php' || curlink == 'edit_publication.php')?'active' : '' ?>">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="material-icons">account_circle</i>
                                    <span class="title">Teacher</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">                               
                                    <li class="nav-item <?php echo (curlink == 'teacher.php' || curlink == 'edit_publication.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'teacher/teacher.php' ?>" class="nav-link ">
                                            <span class="title">Teacher</span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo (curlink == 'edit_publication.php')?'active' : '' ?>">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Publication</span>
                                        </a>
                                    </li>                                   
                                   
                                   
                                </ul>
                            </li>
                            <li class="nav-item <?php echo (curlink == 'student.php' || curlink == 'add_activity.php' || curlink == 'studentpaper.php' || curlink == 'mark.php' || curlink == 'activity.php')?'active' : '' ?>">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="material-icons">people</i>
                                    <span class="title">Student</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?php echo (curlink == 'student.php' || curlink == 'add_activity.php' || curlink == '.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'student/student.php' ?>" class="nav-link ">
                                            <span class="title">Student</span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo (curlink == 'activity.php')?'active' : '' ?>">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Student Activity</span>
                                        </a>
                                    </li>  
                                    <li class="nav-item <?php echo (curlink == 'studentpaper.php')?'active' : '' ?>">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Student Paper</span>
                                        </a>
                                    </li>                                                                                               
                                </ul>
                            </li>  
                            <li
                                class="nav-item <?php echo (curlink == 'rank.php' || curlink=='department.php' || curlink=='semester.php' || curlink=='subject.php' || curlink=='room.php' || curlink=='time.php')?'active' : '' ?>">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="material-icons">settings</i>
                                    <span class="title">Setting</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?php echo (curlink == 'rank.php')?'active' : '' ?>">
                                            <a href="<?php echo roothtml.'setting/rank.php' ?>" class="nav-link ">
                                                <span class="title">ရာထူး</span>
                                            </a>
                                    </li>
                                    <li class="nav-item <?php echo (curlink == 'department.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'setting/department.php' ?>" class="nav-link ">
                                            <span class="title">Department</span>
                                        </a>
                                    </li>                                                                   
                                </ul>
                            </li>
                            <li
                                class="nav-item <?php echo (curlink == 'usercontrol.php' || curlink == 'loghistory.php' )?'active' : '' ?>">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="material-icons">lock</i>
                                    <span class="title">Account</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?php echo (curlink == 'usercontrol.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'Account/usercontrol.php' ?>" class="nav-link ">
                                            <span class="title">User Control</span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo (curlink == 'loghistory.php')?'active' : '' ?>">
                                        <a href="<?php echo roothtml.'Account/loghistory.php' ?>" class="nav-link ">
                                            <span class="title">Log History</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                                                      
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end sidebar menu -->

            <div class="loader" style="display:none;">
                <div class="center-load">
                    <img src="<?php echo roothtml.'lib/images/ajax-loader1.gif'; ?>" />
                </div>
            </div>