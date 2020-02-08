<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to(TP_BACK."admin/login"); }
if($session->is_logged_in())
{
	if($_SESSION['userlevel']!='admin')
	{
		 redirect_to(BASE_PATH);
	}
}
?>
<?php include_layout_template('header.php');
$temp=Template::find_by_id(1);
 ?>
  <?php 
  $page='';
       if($_SERVER['REQUEST_URI'] == "/".MYF."public/admin/" || $_SERVER['REQUEST_URI'] == "/".MYF."public/admin/index.php")  {
	  $page='Admin Panel';
		}
		  if(isset($_GET['cat']))  {
	  $page='Admin Panel';
		}
		
	?>
     <?php echo output_message($message); ?>
	  
<div id="wrapper">

	<div class="main-content">
		 <?php 
       if($_SERVER['REQUEST_URI'] == "/".MYF."public/admin/" || $_SERVER['REQUEST_URI'] == "/".MYF."public/admin/index.php")  {
	   include_layout_template('admin_home.php');
		}else
		{
			 include_resources_template('error.php');   
			}
	?>

		
<?php include_layout_template('footer.php'); ?>
<?php echo toast_msg("success","","Welcome to ".ucfirst($temp->sitename)."",1000);?>

