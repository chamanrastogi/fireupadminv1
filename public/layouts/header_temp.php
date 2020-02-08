<?php
$Template = Template::find_by_id(1);
?><!DOCTYPE html>
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin Panel</title>    
    <link href="<?=BASE_PATH?>assets/img/<?=$Template->favicon?>" rel="shortcut icon" type="image/x-icon" />
	<!-- Main Styles -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/style.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/extra.css">
	<!-- Themify Icon -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/fonts/themify-icons/themify-icons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/waves/waves.min.css">
 
   
	<!-- Sweet Alert -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/sweet-alert/sweetalert.css">
	<!-- Data Tables -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">    
   
   <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/datatables/media/css/buttons.dataTables.min.css">
    	<!-- Popover -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/popover/jquery.popSelect.min.css">
	<!-- Percent Circle -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/percircle/css/percircle.css">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/chart/chartist/chartist.min.css">
<!-- Select2 -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/select2/css/select2.min.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>
<!-- Toastr -->

	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/toastr/toastr.css">
   <!-- Lightview -->
    <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/lightview/css/lightview/lightview.css">
    <script src="<?=TP_BACK?>editor/ckeditor.js"></script>
   
    <!-- Jquery UI -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.theme.min.css">

<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="<?=TP_BACK?>admin" class="logo">Admin Panel</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<?=include_layout_template('side.php');?>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Home</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		<div class="ico-item">
			<a href="#" class="ico-item ti-search js__toggle_open" data-target="#searchform-header"></a>
			<form action="#" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="ti-search button-search" type="submit"></button></form>
			<!-- /.searchform -->
		</div>
         <?php  $rw =User::find_by_id($_SESSION['user_id']); ?>
		<!-- /.ico-item -->
        <a href="<?=BASE_PATH?>" target="_blank" class="ico-item ti-desktop" ></a>
		<a href="#" class="ico-item ti-email notice-alarm js__toggle_open" data-target="#message-popup"></a>
		<a href="#" class="ico-item ti-bell notice-alarm js__toggle_open" data-target="#notification-popup"></a>
		<div class="ico-item">
			 <span> <?=ucfirst($rw->first_name." ".$rw->last_name)?></span>
			<ul class="sub-ico-item">
				<li><a href="<?=TP_BACK?>admin/dashboard/settings">Settings</a></li>
                <li><a href="<?=TP_BACK?>admin/dashboard/user/edit/1">Edit Profile</a></li>
				<li><a href="<?=TP_BACK?>admin/logout">Log Out</a></li>
			</ul>
			<!-- /.sub-ico-item -->
		</div>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="notification-popup" class="notice-popup js__toggle" data-space="75">
	<h2 class="popup-title">Your Notifications</h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-6.jpg" alt=""></span>
					<span class="name">Michael Zenaty</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">50 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-4.jpg" alt=""></span>
					<span class="name">Simon</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">1 hour</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
					<span class="name">Account Contact Change</span>
					<span class="desc">A contact detail associated with your account has been changed.</span>
					<span class="time">2 hours</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-7.jpg" alt=""></span>
					<span class="name">Helen 987</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Yesterday</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-2.jpg" alt=""></span>
					<span class="name">Denise Jenny</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">Oct, 28</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-8.jpg" alt=""></span>
					<span class="name">Thomas William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Oct, 27</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#notification-popup -->

<div id="message-popup" class="notice-popup js__toggle" data-space="75">
	<h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New message</a></h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-1.jpg" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-3.jpg" alt=""></span>
					<span class="name">Harry Halen</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-4.jpg" alt=""></span>
					<span class="name">Thomas Taylor</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-1.jpg" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="<?=TP_BACK?>assets/images/avatar-sm-5.jpg" alt=""></span>
					<span class="name">Helen Candy</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#message-popup -->