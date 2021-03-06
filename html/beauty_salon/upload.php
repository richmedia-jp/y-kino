<?php
	
	require_once('config.php');
	
	$errors =array();



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

		

	




		//POSTなら保存処理実行
	if($_SERVER['REQUEST_METHOD'] ==='POST'){

		//バリデーションスタート

		//美容室名が正しく入力されているかチェック
	$beauty_salon_name = null;
	if(!isset($_POST['beauty_salon_name']) || !strlen($_POST['beauty_salon_name'])){
		$errors['beauty_salon_name'] = '美容室名を入力してください。';
	} 
	else if (strlen($_POST['beauty_salon_name'])>30){
		$errors['beauty_salon_name']='美容室名は30文字以内で入力してください。';
	} 
	else{
		$beauty_salon_name =$_POST['beauty_salon_name'];
	}

	//都道府県が選ばれているかチェック





	//住所１が正しく入力されているかチェック
	$address1 = null;
	
	if(!isset($_POST['address1']) || !strlen($_POST['address1'])){
		$errors['address1'] = '住所１を入力してください。';
	} 
	else if (strlen($_POST['address1'])>45){
		$errors['address1']='住所１は45文字以内で入力してください。';
	} 
	else{
		$address1 =$_POST['address1'];
	}


	//住所2が正しく入力されているかチェック
	$address2 = null;
	if(!isset($_POST['address2']) || !strlen($_POST['address2'])){
		$errors['address2'] = '住所2を入力してください。';
	} 
	else if (strlen($_POST['address2'])>45){
		$errors['address2']='住所2は45文字以内で入力してください。';
	} 
	else{
		$address2 =$_POST['address2'];
	}

	//telが正しく入力されているかチェック
	$tel = null;
	if(!isset($_POST['tel']) || !strlen($_POST['tel'])){
		$errors['tel'] = '電話番号を入力してください。';
	} 
	else if (strlen($_POST['tel'])>13){
		$errors['tel']='電話番号は13文字以内で入力してください。';
	} 
	else{
		$tel =$_POST['tel'];
	}

	//営業時間が正しく入力されているかチェック
	$work_hour= null;
	if(!isset($_POST['work_hour']) || !strlen($_POST['work_hour'])){
		$errors['work_hour'] = '営業時間を入力してください。';
	} 
	else if (strlen($_POST['work_hour'])>45){
		$errors['work_hour']='営業時間は45文字以内で入力してください。';
	} 
	else{
		$work_hour =$_POST['work_hour'];
	}

	//紹介文タイトルが正しく入力されているかチェック
	$intro_title= null;
	if(!isset($_POST['intro_title']) || !strlen($_POST['intro_title'])){
		$errors['intro_title'] = '紹介文タイトルを入力してください。';
	} 
	else if (strlen($_POST['intro_title'])>45){
		$errors['intro_title']='紹介文タイトルは45文字以内で入力してください。';
	} 
	else{
		$intro_title =$_POST['intro_title'];
	}	

	//紹介文本文が正しく入力されているかチェック
	$intro_text= null;
	if(!isset($_POST['intro_text']) || !strlen($_POST['intro_text'])){
		$errors['intro_text'] = '紹介文本文を入力してください。';
	} 
	else{
		$intro_text =$_POST['intro_text'];
	}	

	//バリデーション終わり


	//画像を保存
foreach ($_FILES['upfile']['error'] as $key => $value) {

		if (isset($key)){
		
		


 	//画像のエラーチェック
	if($value != UPLOAD_ERR_OK) {
		echo"エラーが発生しました:";
		exit;
	}

}




	$size = $_FILES['upfile']['size'][$key];	
	if(!$size || $size > MAX_FILE_SIZE){
		echo "ファイルサイズが大きすぎます。";
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
	$salon_photo_name[] = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$imageFileName;

	
	//元画像を保存

	$imageFilePath = IMAGE_DIR .'/'.$imageFileName;

	$rs = move_uploaded_file($_FILES['upfile']['tmp_name'][$key], $imageFilePath);
	if (!$rs) {
		$errors['upfile']= "could not upload";
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


		$beauty_salon_name  = $_REQUEST['beauty_salon_name'];
		$prefectual_id = $_REQUEST['prefectual_id'];
		$address1  = $_REQUEST['address1'];
		$address2  = $_REQUEST['address2'];
		$tel  = $_REQUEST['tel'];
		$work_hour  = $_REQUEST['work_hour'];
		$intro_title  = $_REQUEST['intro_title'];
		$intro_text  = $_REQUEST['intro_text'];
		$recommend_flag  = $_REQUEST['recommend_flag'];
		$beauty_salon_tag_id = $_REQUEST['beauty_salon_tag_id'];
		

	//エラーがなければ保存
	if(count($errors) === 0) {
		
		//保存するためのSQL文を作成
		$sql = "INSERT INTO beauty_salon
						(beauty_salon_name,prefectual_id,address_1,address_2,tel,work_hour,intro_title,intro_text,salon_photo_name_1,salon_photo_name_2,salon_photo_name_3,salon_recommend_flag,beauty_salon_tag_id)
				VALUES
						('$beauty_salon_name','$prefectual_id','$address1','$address2','$tel','$work_hour','$intro_title','$intro_text','$salon_photo_name[0]','$salon_photo_name[1]','$salon_photo_name[2]','$recommend_flag','$beauty_salon_tag_id')";
		//保存する
		mysql_query($sql,$link);
		if (!$sql) {
			exit('データを登録できませんでした。');
		}
	
	}
}
	
	
	include'views/view.php';
		mysql_close($link);

?>