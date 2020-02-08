<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
use Illuminate\Hashing\BcryptHasher;
use Intervention\Image\ImageManager;
class User extends DatabaseObject {
	
	protected static $table_name="users";
    protected static $db_fields=array('id','username','password','email','full_name','avatar','userlevel','created','lastip','status');
  
	public $id;
	public $username;
	public $password;
	public $email;
	public $full_name;
	public $avatar;
	public $userlevel;
	public $created;
	public $lastip;
	public $status;
	protected $folder="users";
	public static function call_cl_fun() {
		return (new User());
    }
    public function destroy($path) {
		// First remove the database entry
		$target_path=SITE_ROOT.DS.'public'.DS.$path;
		if(file_exists($target_path)) {
			// then remove the file
		  // Note that even though the database entry is gone, this object 
			// is still around (which lets us use $this->image_path()).
			
			return unlink($target_path) ? true : false;
		} else {
			// database delete failed
			return false;
		}
	}

	public function image_path() {
	  return FULL_PATH.$this->folder.DS.$this->avatar;
	}
	public function fpath() {
	  return FULL_PATH.$this->folder.DS.$this->image;
	}
	public function path() {
	  return FULL_PATH.$this->folder.DS;
	}
	public function img_path() {
	  return $this->folder.DS;
	}
	public static function image_maker($image,$upload_size)
    {
     $upload_size=($upload_size*1024)*1024;
	 $data=self::call_cl_fun();
	 $size=round($image['size']);
	$n=explode(".",$image['name']);
	$filename=$image["tmp_name"];
    $type=$n[1];	
	if($size>$upload_size)
	{
	?>
    <script>
	alert("Image Size is Larger Than 1MB - <?=$size?>Kb" );
	</script>
    <?php
	redirect_by_js('',100);
	exit();
	
		}
		if($type!='jpg' && $type!='jpeg' && $type!='png')
		{
	?>
    <script>
	alert("Image Type is not jpg or png - <?=$type?>" );
	</script>
    <?php
	redirect_by_js('',100);
	exit();
	
		}	
	 $imgname=$image['name'];	 
     $n=explode('.',$image['name']);
	 $manager = new ImageManager(array('driver' => 'gd'));
	 $image = $manager->make($filename)->save(SITE_ROOT.DS.$data->image_path().$imgname); 
     return $imgname;
	 
    }	
public static function authenticate($username="", $password="") {
    global $database;
    $username = $database->escape_value($username);
    $password = $database->escape_value($password);
	$cs=self::count_by_x("username",$username);
	if($cs==1)
	{
	$xx=self::find_by_user($username);
	}else
	{
		  $msg='Username Not Matched';
		  return $msg;
		  exit();
		  }
	$np=$xx->password;
	$xp=new BcryptHasher();  
	if($xp->check($password,$np,['rounds' => 4]))
	{
		$password=$xx->password;
	}else
	{
		  $msg='Password Not Matched';
		  return $msg;
		  exit();
	}	

    $sql  = "SELECT * FROM users ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
		
	// Common Database Methods
	public static function hd_css() {
	$x=stylesheet_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
	$x.=stylesheet_formate('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css');
	$x.=stylesheet_formate('assets/plugin/datatables/media/css/buttons.dataTables.min.css');	
	$x.=stylesheet_formate('assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css');
	$x.=stylesheet_formate('assets/plugin/lightview/css/lightview/lightview.css');
	echo $x;
  } public static function hd_script() {
	$x=script_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css'); 
	  $x.=script_formate('assets/plugin/datatables/media/js/jquery.dataTables.min.js');
    $x.=script_formate('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/dataTables.buttons.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/buttons.flash.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/jszip.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/pdfmake.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/vfs_fonts.js');
	$x.=script_formate('assets/plugin/datatables/media/js/buttons.html5.min.js');
	$x.=script_formate('assets/plugin/datatables/media/js/buttons.print.min.js');
	$x.=script_formate('assets/scripts/datatables.demo.min.js');
	$x.=script_formate('assets/scripts/image.js');
    $x.=script_formate('assets/plugin/lightview/js/lightview/lightview.js');
	$x.=script_formate('assets/plugin/validator/validator.min.js');
	$x.=self::extra_script();
	  echo $x;
  }	
   public static function extra_script() {
	      $table="user";
	   ?>
	    <script type="text/javascript" language="javascript" >
	
	
			$(document).ready(function() {
				
				var dataTable = $('#<?=$table?>').DataTable( {
					"processing": true,
                     "order": [[ 0, "desc" ]],
					"serverSide": true,
					 dom : 'lBfrtip',
        
		"lengthMenu": [ [10, 25, 50, 100,1000,2000,3000,10000, -1], [10, 25, 50, 100,1000,2000,3000,10000] ],
    "pageLength": 10,
					"ajax":{
						url :"<?=TP_BACK?>resources/ajax_<?=$table?>.php", // json datasource
						type: "post", // method  , by default get
						data: {           
						action: '<?=$table?>',      // etc..
						},						
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		<?php
	   
   }
   public function front_script() {
	   ?>
	   
<script>
	 $(document).ready(function(){
		 $("#loginst").validate({
			rules: {
				username: {
					required: true,
					digits: true,
					minlength:10,
					maxlength:10
				},
				password: {
				required: true,
				minlength: 6
			},
			},
			
		});
$("#loginte").validate({
			rules: {
				username: {
					required: true,
					digits: true,
					minlength:10,
					maxlength:10
				},
				password: {
				required: true,
				minlength: 6
			},
			},
			
		});
		 // validate the comment form when it is submitted
		// validate signup form on keyup and submit		
		
});

	</script>
<?php
  }	
	// Common Database Methods
	public static function find_all() {
		
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
 
  public static function find_by_id($id=0) {
	global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }
   
public static function find_by_field_value($field="",$value="") {
	global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE ".$field."='".$value."' LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }

public static function find_all_by_field_value($field="",$value="") {
	global $database;
    return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE ".$field."='".$value."' LIMIT 1");	
  }
  
  public static function find_by_user($username=0) {
	  global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE username='".$username."' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
 
    
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
public static function count_by_x($field='',$value=0) {
	global $database;
	$sql = "SELECT COUNT(*) FROM ".self::$table_name." WHERE ".$field."='".$value."' ";
    $result_set = $database->query($sql);
	$row = $database->fetch_array($result_set);
    return array_shift($row);
	}
	
	public static function count_all() {
	  global $database;
	  $sql = "SELECT COUNT(*) FROM ".self::$table_name;
    $result_set = $database->query($sql);
	  $row = $database->fetch_array($result_set);
    return array_shift($row);
	}

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){		  				
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	protected function sanitized_attributes2() {
 global $database;
   $cl='';
 $clean_attributes = array();
 // sanitize the values before submitting
 // Note: does not alter the actual value of each attribute
 foreach($this->attributes() as $key => $value){
   if($key!='id' && $key!='record')
  {
  $cl="'";
 
  }else
  {
	  $cl="";
 
	  }
if($key=='id' && $value=='')
{
$value= "NULL";
}
   $clean_attributes[$key] = $cl.$database->escape_value($value).$cl;
 }
 return $clean_attributes;
}

// replaced with a custom save()
// public function save() {
//   // A new record won't have an id yet.
//   return isset($this->id) ? $this->update() : $this->create();
// }

public function create() {
global $database;
// Don't forget your SQL syntax and good habits:
// - INSERT INTO table (key, key) VALUES ('value', 'value')
// - single-quotes around all values
// - escape all values to prevent SQL injection
$attributes = $this->sanitized_attributes2();
 $sql = "INSERT INTO ".self::$table_name." (";
$sql .= join(", ", array_keys($attributes));
 $sql .= ") VALUES (";
$sql .= join(", ", array_values($attributes));
$sql .= ")";
 if($database->query($sql)) {
   $this->id = $database->insert_id();
   return true;
 } else {
   return false;
 }
}
	// replaced with a custom save()
	// public function save() {
	//   // A new record won't have an id yet.
	//   return isset($this->id) ? $this->update() : $this->create();
	// }
public function update_status($val='',$id=0) {
	  global $database;
    $sql=("UPDATE ".self::$table_name." SET `status`='".$val."' WHERE `id`=".$database->escape_value($id)."");
	 if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
  }	
public function update_password($val='',$email=0) {
	  global $database;
    $sql=("UPDATE ".self::$table_name." SET `password`='".$val."' WHERE `email`='".$email."'");
	 if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
  }	
public function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			if($value!='' OR $key=='image')
			{
		  $attribute_pairs[] = "`{$key}`='{$value}'";
			}
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		 $sql .= " WHERE id=". $database->escape_value($this->id);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete($id) {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	 $message='<div align="center">                
                <h4 class="alert alert-danger">Success! Record Deleted Successfully</h4>
                <span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>
            </div>';	 

echo output_message($message);
redirect_by_js("../show",100);
	}

protected static function action_data($id,$type) {	
$data=self::call_cl_fun();
$image_name='';
$temp='';
$checkbox='';
if(isset($_REQUEST['submit'])){
extract($_POST);
$data->username=$username;
$data->full_name=$full_name; 
if($_FILES['avatar']['size']!=0)
{
$data->avatar=$data->image_maker($_FILES['avatar'],1);
}
if(isset($_POST['check_avatar']))
{
$data = self::find_by_id($id);
$tpath=$data->image_path();
if($data->image!='')
{

$data->destroy($tpath);
}
	}
if($type=='edit')
{ 
if($password!='')
{
$xp=new BcryptHasher();
$data->password=$xp->make($password,['rounds' => 4]);
}else
{
$us=User::find_by_id($id);
$data->password=$us->password;	
}

$us=User::find_by_id($id);
$data->created=$us->created; 
$data->lastip=$us->lastip;	
$data->id=$id;
$pp=$data->update();
$message='<div align="center"><h4 class="alert alert-success">Success! Record Updated Successfully</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
echo output_message($message);
redirect_by_js($id,100);
}else
{
$data->password=$password;
$data->created=date('Y-m-d H:i:s'); 
$data->lastip=$_SERVER['REMOTE_ADDR'];
$pp=$data->create();
$message='<div align="center"><h4 class="alert alert-success">Success! New Record Added Successfully</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
echo output_message($message);
redirect_by_js("add",1000);
	}
 }
 
 }
 
 public static function form_data() {
		echo $fo=Forms::form_start();
		
		if($_GET['action']=='add')
		{
		self::action_data('','add');
		$username='';
		$password='';	
		$full_name='';
			
		}
		else
		{
		self::action_data($_GET['id'],'edit');
		$rw = self::find_by_id($_GET['id']);
		$username=$rw->username;
		$full_name=$rw->full_name;
		$impath=$rw->image_path();		
		$image=$rw->avatar;
		$password='';		
	
			}
			
		 echo $fo=Forms::img("Avatar","avatar",$impath,$image);
		 echo $fo=Forms::input("Full Name","full_name",$full_name,1);  
		 echo $fo=Forms::input("Username","username",$username,1);
         echo $fo=Forms::password("Password","password",$password,0);         
		 echo $fo=Forms::submit();
		 echo $fo=Forms::form_end();
	 }
	
 public static function show($pname,$action)
 {
		 echo'<form name="form" action="deleteall.php" method="post">
            <table id="'.$pname.'" class="table table-responsive table-striped table-bordered display" style="width:100%">
              <thead>
               <tr>
                  <th><input type="checkbox" name="checkall"/>
                    Id</th>
                  <th >Name</th>
                  <th >Image</th>
                  <th >Status</th>
                  <th >Options </th>
                </tr>
              </thead>
              
            </table>
          </form>';
		  }
 public static function log_history() {
	 $dps='';
$link='';
$maction='clear';

  $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
 
  ?>
  
  <!-- /.col-xl-6 col-12 -->
  <div class="card-content">
  <ul class="list-inline text-right">
							<li class="margin-bottom-10 "><a href="<?=TP_BACK_SIDE?>user/log_history_clear" class="btn btn-primary btn-rounded waves-effect waves-light">Clear History</a></li>
							
						</ul>
 
      <div class="col-md-12">  
     
      <div class="list-group">
	
        <?php

  if( file_exists($logfile) && is_readable($logfile) && 
			$handle = fopen($logfile, 'r')) {  // read
    echo "<ul class=\"log-entries\">";
		while(!feof($handle)) {
			$entry = fgets($handle);
			if(trim($entry) != "") {
			echo'<a href="#" class="list-group-item">									
			<p class="list-group-item-text">'.$entry.'</p>
			</a>';			
			}
		}
		echo "</ul>";
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}.";
  }

?>

</div>
      </div>
       </div>

  <?php
 }
 public static function log_history_clear() {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		file_put_contents($logfile, '');
	  // Add the first log entry
	  log_action('Logs Cleared', "by User ID : {$_SESSION['user_id']}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
	$message='<div align="center"><h4 class="alert alert-success">Success! Clear the history</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
echo output_message($message);
redirect_by_js("log_history",1000);

   
 }
}

?>
