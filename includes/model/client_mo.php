<?php
	require_once(LIB_PATH.DS.'database.php');
	use Intervention\Image\ImageManager;
	class Client_mo extends Client {
		
		public static function test()
		{
			$x=self::count_all();
			
			}
	}