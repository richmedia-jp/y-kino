
<?php

ini_set('display_errors',1);
define('IMAGE_DIR','/var/www/html/uploads');
define('THUMBNAIL_DIR','/var/www/html/thumbnails');
define('THUMBNAIL_WIDTH', 72);

define('MAX_FILE_SIZE', 1024000);


//error_reporting ('E_ALL | E_STRICT');
//データベースに接続
	$db_host = "localhost";
	$db_user = "yukikino";
	$db_passwd = "yk19911010";

	$link = mysql_connect($db_host,$db_user,$db_passwd);

	if (!$link) {
		die('データベースに接続できません。'.mysql_error());
				}
	//データベースを選択する
	mysql_select_db('beauty_salon',$link);
	mysql_set_charset('utf8');



//GD
if (!function_exists('imagecreatetruecolor')) {
	echo 'GDがインストールされていない';
	exit;
}

?>