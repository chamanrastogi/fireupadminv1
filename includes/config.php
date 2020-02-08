<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
ob_start();

// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER')   ? null : define("DB_USER", "root");
defined('DB_PASS')   ? null : define("DB_PASS", "");
defined('DB_NAME')   ? null : define("DB_NAME", "admin_up");


?>
