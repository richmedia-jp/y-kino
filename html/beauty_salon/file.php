<?php

require_once('config.php');


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

			echo"保存できた！";

			?>
