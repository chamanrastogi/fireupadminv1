<?php
require_once("../../includes/initialize.php");
use Illuminate\Hashing\BcryptHasher;
$Template = Template::find_by_id(1);
if($session->is_logged_in()) {
  redirect_to(TP_BACK."admin");
}
include_layout_template('admin_header.php');
if (isset($_POST['submit'])) { 
$email=$_POST['email_id'];
$cos=User::count_by_x("email",$email);
$data =new User;
if($cos==1)
{
$cos=User::find_by_field_value("email",$email);
$temp=Template::find_by_id(1);
$user=User::find_by_id(1);
$xp=new BcryptHasher();
$password=random();
$npassword=$xp->make($password,['rounds' => 4]);
$data->update_password($npassword,$email);
$msg_body="Your New Password:".$password;
// Form has been submitted.
$msg=Mail_info::mail_body_template($msg_body, "Message From ".$temp->sitename);
Mail_info::mail_msg($temp->email,"noreply@site.com", "Message From ".$temp->sitename,$msg);
}else
{
$type='danger';
$message = 'Error ! </h4> Email address not found';
redirect_by_js(TP_BACK."admin/forget_password",1000,$type,$message);
	}
}
?>
<body>

<div id="single-wrapper">
<form action="#" class="frm-single"  method="post">
		<div class="inside">
        <?php if($message!='')
  {
	  echo'<div class="alert alert-'.$type.'">
                '.$message.'</div><br><center><img src="../assets/loaders/loader_ge.gif" title="c_loader_re.gif"></center>';
	  } ?>
			<div class="title"><strong>Admin</strong>Panel</div>
			<!-- /.title -->
			<div class="frm-title">Reset Password</div>
			<!-- /.frm-title -->
			<p class="text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
			<div class="frm-input"><input type="email" name="email_id"  placeholder="Enter Email" required class="frm-inp"><i class="fa fa-envelope frm-ico"></i></div>
			<!-- /.frm-input -->
			<button type="submit" name="submit" class="frm-submit">Send Email<i class="fa fa-arrow-circle-right"></i></button>
			<a href="<?=TP_BACK."admin/login"?>" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
			<div class="frm-footer text-center">Copyright © <?=date('Y')?> <?=$Template->sitename?></div>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
</div>

	<?php  include_layout_template('admin_footer.php'); ?>