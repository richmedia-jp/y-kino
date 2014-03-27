<<<<<<< HEAD
<?php

	
require_once('config.php');
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

	$errors =array();

//POSTなら保存処理実行
	if($_SERVER['REQUEST_METHOD'] ==='POST'){
		


//バリデーションスタート

		//美容室名が正しく入力されているかチェック
		$beauty_salon_name = null;
	if(!isset($_POST['beauty_salon_name']) || !strlen($_POST['beauty_salon_name'])){
		$errors['beauty_salon_name'] = '美容室名を入力してください。';
	} else if (strlen($_POST['beauty_salon_name'])>30){
		$errors['beauty_salon_name']='美容室名は30文字以内で入力してください。';
	} else{
		$beauty_salon_name =$_POST['beauty_salon_name'];
	}

	//都道府県が選ばれているかチェック





	//住所１が正しく入力されているかチェック
	$address1 = null;
	if(!isset($_POST['address1']) || !strlen($_POST['address1'])){
		$errors['address1'] = '住所１を入力してください。';
	} else if (strlen($_POST['address1'])>45){
		$errors['address1']='住所１は45文字以内で入力してください。';
	} else{
		$address1 =$_POST['address1'];
	}


	//住所2が正しく入力されているかチェック
	$address2 = null;
	if(!isset($_POST['address2']) || !strlen($_POST['address2'])){
		$errors['address2'] = '住所2を入力してください。';
	} else if (strlen($_POST['address2'])>45){
		$errors['address2']='住所2は45文字以内で入力してください。';
	} else{
		$address2 =$_POST['address2'];
	}

	//telが正しく入力されているかチェック
	$tel = null;
	if(!isset($_POST['tel']) || !strlen($_POST['tel'])){
		$errors['tel'] = '電話番号を入力してください。';
	} else if (strlen($_POST['tel'])>13){
		$errors['tel']='電話番号は13文字以内で入力してください。';
	} else{
		$tel =$_POST['tel'];
	}

	//営業時間が正しく入力されているかチェック
	$work_hour= null;
	if(!isset($_POST['work_hour']) || !strlen($_POST['work_hour'])){
		$errors['work_hour'] = '営業時間を入力してください。';
	} else if (strlen($_POST['work_hour'])>45){
		$errors['work_hour']='営業時間は45文字以内で入力してください。';
	} else{
		$work_hour =$_POST['work_hour'];
	}

	//紹介文タイトルが正しく入力されているかチェック
	$intro_title= null;
	if(!isset($_POST['intro_title']) || !strlen($_POST['intro_title'])){
		$errors['intro_title'] = '紹介文タイトルを入力してください。';
	} else if (strlen($_POST['intro_title'])>45){
		$errors['intro_title']='紹介文タイトルは45文字以内で入力してください。';
	} else{
		$intro_title =$_POST['intro_title'];
	}	

	//紹介文本文が正しく入力されているかチェック
	$intro_text= null;
	if(!isset($_POST['intro_text']) || !strlen($_POST['intro_text'])){
		$errors['intro_text'] = '紹介文本文を入力してください。';
	} else{
		$intro_text =$_POST['intro_text'];
	}	

//バリデーション終わり


		//画像を保存
		require_once('config.php');


	if(isset($_FILES['upfile'])){
	if(isset($_FILES['tmp_name'])){
	
	foreach ($_FILES['upfile'] as $key => $value) {
 	

 	//画像のエラーチェック
		 if($_FILES['upfile']['error'][$key] != UPLOAD_ERR_OK) {
	$errors['upfile'][] ="エラーが発生しました:".$_FILES['upfile']['error'][$key];
	exit;
}

$size = filesize($_FILES['upfile']['tmp_name'][$key]);
if(!$size || $size > MAX_FILE_SIZE){
	$errors['upfile'][] ="ファイルサイズが大きすぎます。";
	exit;
}

//保存するファイル名

$imagesize = getimagesize($_FILES['upfile']['tmp_name'][$key]);

switch ($imagesize['mime']) {
	case 'image/gif':
		$ext = '.gif';
		break;
	case 'image/jpeg':
		$ext = 'jpeg';
		break;
	case 'image/png':
		$ext = 'png';
		break;
	case 'image/jpg':
		$ext = 'jpg';
		break;
	default:
		echo "GIF/JPEG/JPG/PNG only";
		exit;
}

$imageFileName = sha1(time().mt_rand()) . $ext;

//元画像を保存

$imageFilePath[] = IMAGE_DIR .'/'.$imageFileName;

$rs = move_uploaded_file($_FILES['upfile']['tmp_name'][$key], $imageFilePath);
if (!$rs) {
	$errors['upfile'][]= "could not upload";
	exit;
}


// 縮小画像を作成、保存

$width = $imagesize[0];
$height = $imagesize[1];

if ($width > THUMBNAIL_WIDTH) {
	//元ファイルを画像タイプによって作る
switch ($imagesize['mime']) {
	case 'image/gif':
		$srcImage = imagecreatefromgif($imageFilePath);
		break;
	case 'image/jpeg':
		$srcImage = imagecreatefromjpeg($imageFilePath);	
		break;
	case 'image/png':
		$srcImage = imagecreatefrompng($imageFilePath);
		break;
		}
	//新しいサイズをつくる
	$thumbHeight = round($height * THUMBNAIL_WIDTH/$width);
	
	//縮小画像を生成
	$thumbImage = imagecreatetruecolor(THUMBNAIL_WIDTH, $thumbHeight);
	imagecopyresampled($thumbImage,$srcImage,0,0,0,0,72,$thumbHeight,$width,$height);
	
	//縮小画像を保存
switch ($imagesize['mime']) {
	case 'image/gif':
		imagegif($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);
		break;
	case 'image/jpeg':
		imagejpeg($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);	
		break;
	case 'image/png':
		imagepng($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);
		break;
		}
		var_dump($imageFilePath);
						}
					}
				}
			}


$beauty_salon_name  = $_REQUEST['beauty_salon_name'];
$prefectual_id = $_REQUEST['prefectual_id'];
$address1  = $_REQUEST['address1'];
$address2  = $_REQUEST['address2'];
$tel  = $_REQUEST['tel'];
$work_hour  = $_REQUEST['work_hour'];
$intro_title  = $_REQUEST['intro_title'];
$intro_text  = $_REQUEST['intro_text'];

	//エラーがなければ保存
	if (count($errors) === 0) {
		
		//保存するためのSQL文を作成
		$sql = "INSERT INTO beauty_salon
		(beauty_salon_name,prefectual_id,address_1,address_2,tel,work_hour,intro_title,intro_text,salon_photo_name_1,salon_photo_name_2,salon_photo_name_3)
		VALUES('$beauty_salon_name','$prefectual_id','$address1','$address2','$tel','$work_hour','$intro_title','$intro_text','$imageFilePath')";
		//保存する
		mysql_query($sql,$link);
		if (!$sql) {
			exit('データを登録できませんでした。');
		}
	
	}
}
	var_dump($sql);

//都道府県の情報を取得
		$result = mysql_query('SELECT prefectual_id ,prefectual_name FROM prefectual_code');
		if (!$result) {
		die('クエリーが失敗しました。'.mysql_error());
				}

//登録タグの情報を取得
		$result2 = mysql_query('SELECT beauty_salon_tag_id ,beauty_salon_tag FROM beauty_salon_tag');
		if (!$result2) {
		die('クエリーが失敗しました。'.mysql_error());
				}

	include'views/view.php';
	mysql_close($link);

=======
<?php

	
require_once('config.php');
//データベースに接続
$link = mysql_connect('localhost','yukikino','yk19911010');

if (!$link) {
	die('データベースに接続できません。'.mysql_error());
}

//データベースを選択する
	mysql_select_db('beauty_salon',$link);

	$errors =array();

//POSTなら保存処理実行
	if($_SERVER['REQUEST_METHOD'] ==='POST'){
		
		//美容室名が正しく入力されているかチェック
		$beauty_salon_name = null;
	if(!isset($_POST['beauty_salon_name']) || !strlen($_POST['beauty_salon_name'])){
		$errors['beauty_salon_name'] = '美容室名を入力してください。';
	} else if (strlen($_POST['beauty_salon_name'])>30){
		$errors['beauty_salon_name']='美容室名は30文字以内で入力してください。';
	} else{
		$beauty_salon_name =$_POST['beauty_salon_name'];
	}

	//都道府県が選ばれているかチェック





	//住所１が正しく入力されているかチェック
	$address1 = null;
	if(!isset($_POST['address1']) || !strlen($_POST['address1'])){
		$errors['address1'] = '住所１を入力してください。';
	} else if (strlen($_POST['address1'])>45){
		$errors['address1']='住所１は45文字以内で入力してください。';
	} else{
		$address1 =$_POST['address1'];
	}


	//住所2が正しく入力されているかチェック
	$address2 = null;
	if(!isset($_POST['address2']) || !strlen($_POST['address2'])){
		$errors['address2'] = '住所2を入力してください。';
	} else if (strlen($_POST['address2'])>45){
		$errors['address2']='住所2は45文字以内で入力してください。';
	} else{
		$address2 =$_POST['address2'];
	}

	//telが正しく入力されているかチェック
	$tel = null;
	if(!isset($_POST['tel']) || !strlen($_POST['tel'])){
		$errors['tel'] = '電話番号を入力してください。';
	} else if (strlen($_POST['tel'])>13){
		$errors['tel']='電話番号は13文字以内で入力してください。';
	} else{
		$tel =$_POST['tel'];
	}

	//営業時間が正しく入力されているかチェック
	$work_hour= null;
	if(!isset($_POST['work_hour']) || !strlen($_POST['work_hour'])){
		$errors['work_hour'] = '営業時間を入力してください。';
	} else if (strlen($_POST['work_hour'])>45){
		$errors['work_hour']='営業時間は45文字以内で入力してください。';
	} else{
		$work_hour =$_POST['work_hour'];
	}

	//紹介文タイトルが正しく入力されているかチェック
	$intro_title= null;
	if(!isset($_POST['intro_title']) || !strlen($_POST['intro_title'])){
		$errors['intro_title'] = '紹介文タイトルを入力してください。';
	} else if (strlen($_POST['intro_title'])>45){
		$errors['intro_title']='紹介文タイトルは45文字以内で入力してください。';
	} else{
		$intro_title =$_POST['intro_title'];
	}	

	//紹介文本文が正しく入力されているかチェック
	$intro_text= null;
	if(!isset($_POST['intro_text']) || !strlen($_POST['intro_text'])){
		$errors['intro_text'] = '紹介文本文を入力してください。';
	} else{
		$intro_text =$_POST['intro_text'];
	}	




	//エラーがなければ保存
	if (count($errors) === 0){
		//保存するためのSQL文を作成
		$sql = "INSERT INTO `beauty_salon`(`beauty_salon_name`,`address1`,`address2`,`tel`,`work_hour`,`intro_title`,`intro_text`,`salon_photo_name_1`,`salon_photo_name_2`,`salon_photo_name_3`) VALUES('"
			.mysql_real_escape_string($beauty_salon_name) ."','"
			.mysql_real_escape_string($address1) ."','"
			.mysql_real_escape_string($address2) ."','"
			.mysql_real_escape_string($tel) ."','"
			.mysql_real_escape_string($work_hour) ."','"
			.mysql_real_escape_string($intro_title) ."','"
			.mysql_real_escape_string($intro_text) ."','"
			.mysql_real_escape_string($address1) ."')";
	
		//保存する
		mysql_query($sql,$link);


	}


}

//都道府県の情報を取得
		$result = mysql_query('SELECT prefectual_name FROM prefectual_code');
		if (!$result) {
		die('クエリーが失敗しました。'.mysql_error());
				}


		mysql_close($link);

	

		include'views/view.php';	

		//画像を保存
		require_once('config.php');

	if(isset($_FILES['upfile'])){
		
	
		foreach ($_FILES['upfile'] as $key => $value) {
 	
		 if($_FILES['upfile']['error'][$key] != UPLOAD_ERR_OK) {
	$errors['upfile'][] ="エラーが発生しました:".$_FILES['upfile']['error'][$key];
	exit;
}

$size = filesize($_FILES['upfile']['tmp_name'][$key]);
if(!$size || $size > MAX_FILE_SIZE){
	$errors['upfile'][] ="ファイルサイズが大きすぎます。";
	exit;
}


//保存するファイル名

$imagesize = getimagesize($_FILES['upfile']['tmp_name'][$key]);

switch ($imagesize['mime']) {
	case 'image/gif':
		$ext = '.gif';
		break;
	case 'image/jpeg':
		$ext = 'jpeg';
		break;
	case 'image/png':
		$ext = 'png';
		break;
	case 'image/jpg':
		$ext = 'jpg';
		break;
	default:
		echo "GIF/JPEG/JPG/PNG only";
		exit;
}

$imageFileName = sha1(time().mt_rand()) . $ext;

//元画像を保存

$imageFilePath = IMAGE_DIR .'/'.$imageFileName;

$rs = move_uploaded_file($_FILES['upfile']['tmp_name'][$key], $imageFilePath);
if (!$rs) {
	$errors['upfile'][]= "could not upload";
	exit;
}

// 縮小画像を作成、保存

$width = $imagesize[0];
$height = $imagesize[1];

if ($width > THUMBNAIL_WIDTH) {
	//元ファイルを画像タイプによって作る
switch ($imagesize['mime']) {
	case 'image/gif':
		$srcImage = imagecreatefromgif($imageFilePath);
		break;
	case 'image/jpeg':
		$srcImage = imagecreatefromjpeg($imageFilePath);	
		break;
	case 'image/png':
		$srcImage = imagecreatefrompng($imageFilePath);
		break;
}
	//新しいサイズをつくる
	$thumbHeight = round($height * THUMBNAIL_WIDTH/$width);
	
	//縮小画像を生成
	$thumbImage = imagecreatetruecolor(THUMBNAIL_WIDTH, $thumbHeight);
	imagecopyresampled($thumbImage,$srcImage,0,0,0,0,72,$thumbHeight,$width,$height);
	
	//縮小画像を保存
switch ($imagesize['mime']) {
	case 'image/gif':
		imagegif($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);
		break;
	case 'image/jpeg':
		imagejpeg($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);	
		break;
	case 'image/png':
		imagepng($thumbImage,THUMBNAIL_DIR.'/'.$imageFileName);
		break;
}
}
}
}


>>>>>>> 642068f6bc18e761c98f54ab644e833a40047b61
?>