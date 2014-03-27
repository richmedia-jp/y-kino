<?php

ini_set('display_errors',1);
define('IMAGE_DIR','/var/www/html/uploads');
define('THUMBNAIL_DIR','/var/www/html/thumbnails');
define('THUMBNAIL_WIDTH', 72);

define('MAX_FILE_SIZE', 1024000);


//error_reporting ('E_ALL | E_STRICT');



//GD
if (!function_exists('imagecreatetruecolor')) {
	echo 'GDがインストールされていない';
	exit;
}

?>