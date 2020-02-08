<?php
$Template = Template::find_by_id(1);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin Panel</title> 
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">   
    <link href="<?=BASE_PATH?>assets/img/<?=$Template->favicon?>" rel="shortcut icon" type="image/x-icon" />
	<!-- Main Styles -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/style.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/extra.css" >
	<!-- Themify Icon -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/fonts/themify-icons/themify-icons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/waves/waves.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/toastr/toastr.css">
	<!-- Code Styleheets -->
	<?php 
	
	
       if(isset($_GET['pname'],$_GET['action']))  {
		 // echo $_GET['pname'];
		  if($_GET['pname']=="menus" || $_GET['pname']=="logfile" )
		  {
			 Menus::hd_css();
		  }else
		  {
			 $_GET['pname']::hd_css();  
		 }
		}
		else		
		{
		Template::hd_css();
			}
			
			
	?>
    <!--End Code Styleheets -->
   


   <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.theme.min.css">

<script src="<?=TP_BACK?>editor/ckeditor.js"></script>
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
		
         <?php  $rw =User::find_by_id($_SESSION['user_id']); ?>
		<!-- /.ico-item -->
        <a href="<?=BASE_PATH?>" target="_blank" class="ico-item ti-desktop" ></a>
		<a href="<?=TP_BACK?>admin/dashboard/settings"  class="ico-item ti-settings" ></a>
        <a href="<?=TP_BACK?>admin/dashboard/user/edit/1" class="ico-item ti-user" ></a>
        <a href="<?=TP_BACK?>admin/logout" class="ico-item  ti-share-alt" ></a>
		<div class="ico-item">
			 <span> <?=ucfirst($rw->full_name)?></span>
			
			<!-- /.sub-ico-item -->
		</div>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
