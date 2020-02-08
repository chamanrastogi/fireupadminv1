<!-- /.row -->
<?php $temp=Template::find_by_id(1); ?>		
		
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
<footer class="footer" >
<p class="text-right"><strong>Copyright © <?=date('Y')?> <span class="hinditext"><?=$temp->sitename?></span></strong></p>
</footer>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?=TP_BACK?>assets/script/html5shiv.min.js"></script>
		<script src="<?=TP_BACK?>assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?=TP_BACK?>assets/scripts/jquery.min.js"></script>	
	<script src="<?=TP_BACK?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?=TP_BACK?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/toastr/toastr.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/toastr.demo.min.js"></script> 
    <script src="<?=TP_BACK?>assets/plugin/waves/waves.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Page Script Code -->
     <?php 
       if(isset($_GET['pname'],$_GET['action']))  {
		  // echo $_GET['pname'];
		  if($_GET['pname']=="menus" || $_GET['pname']=="logfile" )
		  {
			 Menus::hd_script();
		  }else
		  {
			 $_GET['pname']::hd_script();  
		 }
		}
		else		
		{
		Template::hd_script();
		Template::other_script();
			}
			
	?>
     <!-- End Page Script Code -->
	<script src="<?=TP_BACK?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/chart.sparkline.init.min.js"></script> 
    <script type="text/javascript" src="<?=TP_BACK?>assets/scripts/loader.js"></script>
     <script src="<?=TP_BACK?>assets/scripts/form.demo.min.js"></script> 
    <script src="<?=TP_BACK?>assets/scripts/main.min.js"></script>


</body>
</html>