<?php
require_once(LIB_PATH.DS."config.php");

class MySQLDatabase {
	
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
  function __construct() {
    $this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysql_real_escape_string" );
  }

	public function open_connection() {
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
		if (!$this->connection) {
			die("Database connection failed: " . mysqli_connect_errno());
		} else {
			
		}
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql) {
		$this->last_query = $sql;
		$result = mysqli_query($this->connection,$sql);
		$this->confirm_query($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string($this->connection, $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	public function chars() {			
	mysqli_query($this->connection,"SET CHARACTER SET utf8");
        mysqli_query($this->connection,"SET NAMES utf8");
}
	 public function real_escape_string($value) {
	return mysqli_real_escape_string($this->connection, $value );
	 }
	// "database-neutral" methods
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }
   public function fetch_assoc($result_set) {
    return mysqli_fetch_assoc($result_set);
  }
  public function num_rows($result_set) {
   return mysqli_num_rows($result_set);
  }
  
  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }

	private function confirm_query($result) {
		$actual_link='';
		if (!$result) {
	    //$output = "<div class='da-message error'>Database query failed: " . mysqli_error($this->connection) . "<div>";
	    //$output .= "Last SQL query: " . $this->last_query;
		 //$actual_link ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
		//  die( $output );		
		 $output = '
		 <div class="alert alert-danger" role="alert">                
                <h4>Error!</h4>
				<p><strong class="btn-info">Database query failed: : </strong>'.mysqli_error($this->connection).'</p>
               <strong class="btn-info">Last SQL query</strong>: </strong>'.$this->last_query.'</strong>
			   <p><a href="'.$actual_link.'" class="btn btn-danger">Go Back</a></p>
			   
            </div>
    ';
	    die( $output );
		}
	}
	
}

$database = new MySQLDatabase();
$db =& $database;

?>