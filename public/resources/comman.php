<?php
$action=$_GET['action'];
$pname=$_GET['pname'];
$pname_title=str_replace("_"," ",$_GET['pname']);
if(strtolower($_GET['pname'])!='menus')
{
	if($_GET['action']=='show')
	{
	$maction="add";
 $url='<a href="'.TP_BACK_SIDE.$_GET['pname'].'/'.$maction.'">';
	}else
	{
			$maction="show";
 $url='<a href="'.TP_BACK_SIDE.$_GET['pname'].'/'.$maction.'">';
		}
}else
{
	$maction="show";
  $url='<a href="'.TP_BACK.'admin/menu.php?act=menu">';
}
?>

<div class="row small-spacing">  
  <!-- /.col-xl-6 col-12 -->
  
  <div class="col-xl-6 col-12">
    <div class="box-content card white">
      <h4 class="box-title"><?=ucfirst($_GET['action'])?> <?=ucfirst($pname_title)?>
        <div style="float:right">
      <?=$url?>	
          <?=ucfirst($maction)?> <?=ucfirst($pname_title)?>
          </a>	
       </div>
      </h4>
      <!-- /.box-title -->
      <div class="card-content">
        <?php
		
		if($action=='add' || $action=='edit')
		  {
			 if($pname=="menus")
		  {
		   Menus::form_data();
		  }else{
			$pname::form_data();  
		  }
  		  }else
		  {
			  if(method_exists($pname,$action)) 
			  {
		  $pname::$action($pname,$action);
			  }else
			  {
				  echo "Function Not Found";
				  }
			  }
		?>
      </div>
    </div>
  </div>
</div>
