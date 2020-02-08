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
<?php 

include_layout_template('header.php');

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
		
       if(isset($_GET['pname'],$_GET['action']))  {
		   $found=0;
		 $action=$_GET['action'];
$pname=$_GET['pname'];
if(class_exists($pname))
{
	
	if(method_exists($pname,"form_data"))
	{
		 $found=1;
	}
	
	}
	
	   if($found==1)
	   {
	   include_resources_template('comman.php');
	   }elseif($_GET['pname']!='logfile')
	   {
	 include_resources_template('error.php');		
	   }else
	   {
		    include_resources_template('comman.php');
		   }
		}
		
		if(isset($_GET['other']))
		{
			if($_GET['other']!='')
			{
			
		 include_resources_template($_GET['other'].'.php');	
			}else
	   {
		  
		 include_resources_template('error.php');   
	   }
	    }
	?>
<?php  include_layout_template('footer.php'); ?>
