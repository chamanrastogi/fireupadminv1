<?php
//error_reporting(0);
include('includes/initialize.php');
$data = new Mysql_code_genrator();
//---------------blueprint Area------------------//

$table="client";   //-------------table name---------//
echo $x=$data->clearall($table);

?>
