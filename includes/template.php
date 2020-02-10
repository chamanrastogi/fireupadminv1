<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
	use Intervention\Image\ImageManager;
class Template extends DatabaseObject {
	
	protected static $table_name="`template`";
	protected static $db_fields=array('id','sitename','logo','favicon','email','description','keyword','ana','mail_line');
	public $id;
	public $sitename;
	public $logo;
	public $favicon;
	public $email;
	public $description;
	public $keyword;
	public $ana;
	public $mail_line;
	protected $folder="logo";
	
	public static function call_cl_fun() {
		return (new Template());
  }
	public function destroy() {
		// First remove the database entry
		if($this->delete()) {
			// then remove the file
		  // Note that even though the database entry is gone, this object 
			// is still around (which lets us use $this->image_path()).
			$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			// database delete failed
			return false;
		}
	}

	public function image_path() {
	   return FULL_PATH.$this->folder.DS.$this->logo;
	}
	public function image_path2() {
	   return FULL_PATH.$this->folder.DS.$this->favicon;
	}
	public function path() {
	   return FULL_PATH.$this->folder;
	}
public function Upload_img($imgpath,$image) {
	$path=SITE_ROOT.DS.$imgpath;
    $size= 1000000;	
	$allowedFile = array("jpg","png");
		// call the Upload class and upload file
		$upload = new Upload($image,$path,$size,$types);
		// show results
		$result = $upload->GetResult();
	if($result['fname']=='success')
	{
		$message='<div align="center">                
                <h4 class="alert alert-success">'.$result['message'].'</h4>                
            </div>';
echo output_message($message);
		}else
		{
				$message='<div align="center">                
                <h4 class="alert alert-danger">'.$result['message'].'</h4>                
            </div>';
echo output_message($message);
redirect_by_js("add",1000);
exit();
			}
	return $result['fname']; 
	
	}
public function Upload_img_edit($imgpath,$imagename,$temp,$checkbox) {
	 $path=SITE_ROOT.DS.$imgpath;
	$types=array("jpg","png");
    $size= 1000000;	

	
if(($checkbox==1) && $temp!='')
{

unlink($path.$temp);

}else
{
	 if($imagename['name']!='')
	 {
		
		// call the Upload class and upload file
		$upload = new Upload($imagename,$path,$size,$types);
		// show results
		$result = $upload->GetResult();
		
	if($result['type']=='success')
	{
	
		$message='<div align="center">                
                <h4 class="alert alert-success">'.$result['message'].'</h4>                
            </div>';
echo output_message($message);
		}else
		{
				$message='<div align="center">                
                <h4 class="alert alert-danger">'.$result['message'].'</h4>                
            </div>';
echo output_message($message);
		}
	
	return $result['fname'];
			}else
			{
				return $temp;
				}
	 
}
	return ''; 
	}
	
	
	// Common Database Methods
	// Common Database Methods
	public static function hd_css() {
	$x=stylesheet_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
	$x.=stylesheet_formate('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css');
	$x.=stylesheet_formate('assets/styles/jquery-ui.css');
	$x.=stylesheet_formate('elfinder/css/elfinder.min.css');
	$x.=stylesheet_formate('elfinder/css/theme.css');
	$x.=stylesheet_formate('assets/plugin/lightview/css/lightview/lightview.css');
	
		
		
	echo $x;
  } public static function hd_script() {
	$x=script_formate('assets/scripts/image.js');
	$x.=script_formate('assets/plugin/validator/validator.min.js');
	$x.=script_formate('elfinder/js/elfinder.min.js');
	$x.=script_formate('assets/plugin/lightview/js/lightview/lightview.js');
	  echo $x;
  }	
   public static function other_script() {
	   
	   ?>
<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$(document).ready(function() {
				$('#elfinder').elfinder(
					// 1st Arg - options
					{
						cssAutoLoad : false,               // Disable CSS auto loading
						baseUrl : './',                    // Base URL to css/*, js/*
						url : '<?=TP_BACK?>elfinder/php/connector.minimal.php'  // connector URL (REQUIRED)
						// , lang: 'ru'                    // language (OPTIONAL)
					},
					// 2nd Arg - before boot up function
					function(fm, extraObj) {
						// `init` event callback function
						fm.bind('init', function() {
							// Optional for Japanese decoder "encoding-japanese.js"
							if (fm.lang === 'ja') {
								fm.loadScript(
									[ '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js' ],
									function() {
										if (window.Encoding && Encoding.convert) {
											fm.registRawStringDecoder(function(s) {
												return Encoding.convert(s, {to:'UNICODE',type:'string'});
											});
										}
									},
									{ loadType: 'tag' }
								);
							}
						});
						// Optional for set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					}
				);
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
   public static function fees($fee="") {
    global $database;
	$sql="update template set t_fee='".$fee."' where id='1'";

    
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
		$attributes = $this->sanitized_attributes();
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
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
	
	
public static function action_data($id) {	 
	$data=self::call_cl_fun();
	$logo='';
	$favicon='';
	$temp='';
	$checkbox='';
	$temps='';
	$checkboxs='';
 if(isset($_REQUEST['submit'])){
	extract($_POST);
$data->sitename=$sitename;

 if($_FILES['logo']['size']!=0)
	  {  
      $data->logo=$data->image_maker($_FILES['logo']);
	  }
	 if($_FILES['favicon']['size']!=0)
	  {    
      $data->favicon=$data->image_maker($_FILES['favicon']);
	  } 
	$data->email=$email;
	$data->keyword=$keyword;
	$data->description=$description;
	$data->ana=$ana;
	$data->mail_line=$mail_line;
	$data->id=1;
	$pp=$data->update();
	$message='<div align="center">                
                <h4 class="alert alert-success">Success! Record Updated Successfully</h4>
                <span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>
            </div>';	 

echo output_message($message);
redirect_by_js("".TP_BACK."admin/dashboard/settings",100);
 }
}
	public function delete() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	
		// NB: After deleting, the instance of User still 
		// exists, even though the database entry does not.
		// This can be useful, as in:
		//   echo $user->first_name . " was deleted";
		// but, for example, we can't call $user->update() 
		// after calling $user->delete().
	}
	public static function backupsql() {		
		$data=Template_mo::backnow();
		backup_action('File Name', "{$data}");
		redirect_by_js("backnow_history",100);
  }
  public static function backnow_history() {		
		Template_mo::backnow_his();
		
  }
   public static function backup_history_clear() {		
		Template_mo::backup_history_clears();
		
  }

public static function form_data() {
		     echo $fo=Forms::form_start();			
			  self::action_data(1,'edit');
			  $data = self::find_by_id(1);
			  $impath=$data->image_path2();
			  $impath2=$data->image_path();
			  
			  $sitename=$data->sitename;
			  
			  $email=$data->email;
			  $favicon=$data->favicon;
			  $logo=$data->logo;
			  $keyword=$data->keyword;
			  $description=$data->description;
			  $ana=$data->ana;
			  $mail_line=$data->mail_line;

			  echo $fo=Forms::image_simple_edit("Logo","logo",$impath2,$logo); 
			  echo $fo=Forms::image_simple_edit("Favicon","favicon",$impath,$favicon);       
			  echo $fo=Forms::input_hn("Sitename","sitename",$sitename,1);
			  echo $fo=Forms::input("Email","email",$email,0);  
			  echo $fo=Forms::input("Mail Line","mail_line",$mail_line,0);		  
			  echo $fo=Forms::text_editor("keyword","keyword",$keyword,'',0);
			  echo $fo=Forms::text_editor("Description","description",$description,'',0);
			  echo $fo=Forms::text_editor("Analytics Code","ana",$ana,'',0);
			  echo $fo=Forms::submit();
			  echo $fo=Forms::form_end();
	 }
}

?>
