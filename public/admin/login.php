<?php
require_once("../../includes/initialize.php");
$Template = Template::find_by_id(1);
if($session->is_logged_in()) {
  redirect_to(TP_BACK."admin");
}
include_layout_template('admin_header.php');
// Remember to give your form's submit tag a name="submit" attribute!
$type='';
if (isset($_POST['submit'])) { // Form has been submitted.

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

//$password =md5($password);
    
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);

  if (is_object($found_user)) {
    $session->login($found_user);
	log_action('Login', "{$found_user->username} logged in.");
	$type='success';
	$message = 'Success ! </h4> Login Successfull';
			
	redirect_by_js(TP_BACK."admin",1000,$type,$message);
	?>
	
<?php	
 
  } else {
    // username/password combo was not found in the database
    $type='danger';
	$message = $found_user;
	redirect_by_js("login",1000,$type,$message);
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<style>
.form-group .form-control .frm-ico {
    position: absolute;
    top: 0;
    left: 3px;
    width: 30px;
    font-size: 18px;
    line-height: 40px;
    text-align: center;
    color: #999;
    transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    -webkit-transition: all .4s ease;
}
</style>

<body>

<div id="single-wrapper">
 
    
	<form action="login"  method="POST" class="frm-single"  data-toggle="validator" role="form">
		<div class="inside">
			<div class="title"><strong>Admin</strong>Panel</div>
             <?php if($message!='')
  {
	  echo'<div class="alert alert-'.$type.'">
                '.$message.'</div><br><center><img src="../assets/loaders/loader_ge.gif" title="c_loader_re.gif"></center>';
	  } ?>
			<!-- /.title -->
			<div class="frm-title">Login</div>
			<!-- /.frm-title -->
                  <div class="form-group">
          <label for="inputName" class="control-label">Name</label>
          <input type="text" class="form-control" id="inputName" name="username" placeholder="Username" value="<?=htmlentities($username); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="inputName" class="control-label">Password</label>
          <input type="password"  maxlength="12"  placeholder="Password" name="password" value="<?=htmlentities($password); ?>" required class="form-control">
        </div>
        
			
			<!-- /.frm-input -->
			<div class="clearfix margin-bottom-20">
				<div class="pull-left">
					<div class="checkbox primary"><input type="checkbox" id="rememberme"><label for="rememberme">Remember me</label></div>
					<!-- /.checkbox -->
				</div>
				<!-- /.pull-left -->
				<div class="pull-right"><a href="<?=TP_BACK."admin/forget_password"?>" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
				<!-- /.pull-right -->
			</div>
			<!-- /.clearfix -->
			<button type="submit" name="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			
			<!-- /.row -->
			
			<div class="frm-footer text-center">Copyright © <?=date('Y')?> <?=$Template->sitename?></div>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->

	<?php  include_layout_template('admin_footer.php'); ?>