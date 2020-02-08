<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
	
class Template_mo extends Template {
	
	public static function che() {
		echo "hello word";
  }
}