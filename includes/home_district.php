<?php
	require_once(LIB_PATH.DS.'database.php');
	use Intervention\Image\ImageManager;
	use Stichoza\GoogleTranslate\GoogleTranslate;
	class Home_district extends DatabaseObject {
	protected static $table_name="home_district";
	protected static $db_fields=array('id','name','status');
	
    public $id;
    public $name;
    public $status;
    protected $folder="home_district";
    public $errors=array();
  
    public static function call_cl_fun() {
    return (new Home_district());
    }
    
public static function hd_css() {
	$x=stylesheet_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
	$x.=stylesheet_formate('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css');
	$x.=stylesheet_formate('assets/plugin/datatables/media/css/buttons.dataTables.min.css');
	$x.=stylesheet_formate('assets/plugin/datepicker/css/bootstrap-datepicker.min.css');
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
   $table=self::$table_name;
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
  public function destroy($path) {
		// First remove the database entry
		 $target_path=SITE_ROOT.DS.$path;
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
	  return FULL_PATH.$this->folder.DS.$this->image;
	}
	
	public function fpath() {
	  return FULL_PATH.$this->folder.DS.$this->image;
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
		
	$message='<div align="center">                
                <h4 class="alert alert-danger">Image Size is Larger Than 1MB '.$size.'Kb</h4>                
            </div>';
echo output_message($message);
redirect_by_js('',1000);
	exit();
	
		}
		if($type!='jpg' && $type!='jpeg' && $type!='png')
		{
			toast_msg("Error","","Image type is not jpg or png -".$type."",1000);
			$message='<div align="center">                
                <h4 class="alert alert-danger">Image type is not jpg or png - '.$type.'</h4>                
            </div>';
echo output_message($message);
redirect_by_js('',1000);
	?>
  
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
 
public static function find_by_name($name=0) {
	  global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE name='".$name."' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
 
  
  public static function find_in_not($id='') {
  global $database;
  return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE `id` NOT IN (".$database->escape_value($id).")");		
  }

  public static function find_by_not_in($id='') {
  global $database;
  return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE `id` NOT IN (".$database->escape_value($id).")");		
  }  

  public static function find_by_in($id='') {
  global $database;
 
 return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE `id` IN (".$database->escape_value($id).")");		
  }
   public static function find_by_status_id($id=0) {
	  global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$database->escape_value($id)." AND status='Active' LIMIT 1");
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

protected function create() {
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
protected function update_status($val='',$id=0) {
	  global $database;
    $sql=("UPDATE ".self::$table_name." SET `status`='".$val."' WHERE `id`=".$database->escape_value($id)."");
	 if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
  }	
	
protected function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		
		foreach($attributes as $key => $value) {
			if($value!='' )
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

	protected function delete($id) {
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

public function status_data($id){
	$mo = self::find_by_id($id);
if($mo->status=='Active')
{ 
$mo->update_status('Deactive',$_GET['id']);
$message='<div align="center">                
                <h4 class="alert alert-success">Success! Status Deactive Now</h4>                
            </div>';
echo output_message($message);
redirect_by_js('../show',10);
}
else
{
$mo->update_status('Active',$_GET['id']);
$message='<div align="center">                
                <h4 class="alert alert-success">Success! Status Active Now</h4>                
            </div>';
echo output_message($message);
echo output_message("Status Active Now");
redirect_by_js('../show',10);
}	
	}
	public function delete_data($id){
	
	$data = self::find_by_id($id);
$tpath=$data->image_path();
if($data->image!='')
{

$data->destroy($tpath);
}
self::delete($id);
}
public static function show($pname,$action)
 {
		 echo'<form name="form" action="deleteall.php" method="post">
            <div class="table-responsive" data-pattern="priority-columns">
            <table id="'.$pname.'" class="table table-responsive table-striped table-bordered display" style="width:100%">
             
              <thead>
               <tr>
                  <th><input type="checkbox" name="checkall"/>
                    Id</th>
                  <th >Name</th>
                  <th >-</th>
                  <th >Status</th>
                  <th >Options </th>
                </tr>
              </thead>
              
            </table></div>
          </form>';
		  }public static function form_data() {
	echo $fo=Forms::form_start();
	if($_GET['action']=='add')
	{
	self::action_data('','add');
    $name='';
    }
	else
	{$check=self::count_by_x("id",$_GET['id']);
		if($check==0)
		{
			$message='
			<div class="alert alert-warning text-center" role="alert"> <strong>Error!</strong>No! Record Exists    <span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span> </div>
</div>';
			
			 echo output_message($message);
			
redirect_by_js(BASE_PATH.BASE_FOLDER.DS."admin",500);
exit();
		}
	self::action_data($_GET['id'],'edit');
	
    $rw=self::find_by_id($_GET['id']);
	  
        $name=$rw->name;
		}
		//$tr = new GoogleTranslate('hi');
		//$names=$tr->translate($name);		
		//echo"<div class='form-group text-center'>". $names."</div>";
		echo $fo=Forms::input_hn("Name","name",$name,1);
		
	 echo $fo=Forms::submit();
	 echo $fo=Forms::form_end();
	 }	
      protected static function action_data($id,$type) {
        $data=self::call_cl_fun();
        if(isset($_REQUEST['submit']))
        {
      extract($_POST);
          $data->name=$name;
      
	  if($type=='edit')
{ 

  $data->id=$id;
  $rw=self::find_by_id($id);
	 $data->status=$rw->status;
  
  $pp=$data->update();
  $message='<div align="center"><h4 class="alert alert-success">Success! Record Updated Successfully</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
  echo output_message($message);
redirect_by_js($id,100);
}else
{

	 $data->status="Active";
  $pp=$data->create();
$message='<div align="center"><h4 class="alert alert-success">Success! New Record Added Successfully</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
echo output_message($message);
redirect_by_js('add',1000);
	}
	  }
}
}