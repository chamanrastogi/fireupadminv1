<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
	
class Template extends DatabaseObject {
	
	
public static function backnow() {
	$time=date('Y-m-d_H:i:s(p)');
		$simpleBackup = SimpleBackup::setDatabase([DB_NAME,DB_USER,DB_PASS,DB_SERVER])
  ->storeAfterExportTo('backup', 'mybackup_');
	 }
	 public static function backnow_table_in($a=array()) {
		$simpleBackup = SimpleBackup::setDatabase([DB_NAME,DB_USER,DB_PASS,DB_SERVER])
  ->storeAfterExportTo('backup', 'mybackup');
	 }
	  public static function backnow_table_out($a=array()) {
		$simpleBackup = SimpleBackup::setDatabase([DB_NAME,DB_USER,DB_PASS,DB_SERVER])
  ->storeAfterExportTo('backup', 'mybackup');
	 }
}

?>
