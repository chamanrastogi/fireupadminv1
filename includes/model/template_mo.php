<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');
use Coderatio\SimpleBackup\SimpleBackup;
class Template_mo extends Template {
	
	public static function backnow() {
	 $time=date('d-m-Y(H.i.s A)');
	
	$simpleBackup = SimpleBackup::setDatabase([DB_NAME,DB_USER,DB_PASS,DB_SERVER])
  ->storeAfterExportTo(SITE_ROOT.DS."includes".DS.'backup', 'mybackup_'.$time);
  return $simpleBackup->getExportedName();
	 }
	 public static function backnow_table_in($arr) {
	SimpleBackup::start()
    ->setDbName(DB_NAME)
    ->setDbUser(DB_USER)
    ->setDbPassword(DB_PASS)
    ->includeOnly($arr)
    ->then()->storeAfterExportTo('backups')
    ->then()->getResponse();
	 }
	public static function backnow_table_out($arr) {
	SimpleBackup::start()
    ->setDbName(DB_NAME)
    ->setDbUser(DB_USER)
    ->setDbPassword(DB_PASS)
    ->excludeOnly($arr)
    ->then()->storeAfterExportTo('backups')
    ->then()->getResponse();
	 }
	 public static function backup_history_clears()	 
	 {
	  $logfile = SITE_ROOT.DS.'logs'.DS.'backup.txt';
	  file_put_contents($logfile, '');
	  // Add the first log entry
	  log_action('Logs Cleared', "by User ID : {$_SESSION['user_id']}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
	$message='<div align="center"><h4 class="alert alert-success">Success! Clear the history</h4><span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>

</div>';
echo output_message($message);
redirect_by_js("backnow_history",1000);

   
 }
	 
	public static function backnow_his() {
		  $dps='';
$link='';
$maction='clear';

  $logfile = SITE_ROOT.DS.'logs'.DS.'backup.txt';
 
  ?>
  
  <!-- /.col-xl-6 col-12 -->
  <div class="card-content">
  <ul class="list-inline text-right">
	<li class="margin-bottom-10 "><a href="<?=TP_BACK_SIDE?>template/backup_history_clear" class="btn btn-primary btn-rounded waves-effect waves-light">Clear History</a></li></ul>
 
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
}