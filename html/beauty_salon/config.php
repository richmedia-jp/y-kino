<<<<<<< HEAD
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

=======
<<<<<<< HEAD
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

=======
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

>>>>>>> 642068f6bc18e761c98f54ab644e833a40047b61
>>>>>>> a737cf711deca5fbb83e963f8c96da845b492e6b
?>