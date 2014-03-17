<?php



	require_once('config.php');

	$images =array();

	$imagesDir = opendir(IMAGE_DIR);

	while ($file = readdir($imagesDir)) {
		if( $file == '.' || $file == '..'){
			continue;
		}
		if (file_exists(THUMBNAIL_DIR.'/'.$file)) {
			$images[]='../../thumbnails/'.$file;
		}else
			$images[] ='../../uploads/'.$file;
	}

?>
<html>
<head>
	<title>test</title>
</head>
<body>
<form action="upload.php" method="post"enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>">
<li class="image1"><input type="file" name="upfile[]" size="30"></li>
<li class="image1"><input type="file" name="upfile[]" size="30"></li>
<li class="image1"><input type="file" name="upfile[]" size="30"></li>
<input type="submit" value="upload">
</form>
<hr>
<?php foreach ($images as $image) :?>
	<?php if(strpos($image, '../../thumbnails') === 0):?>
	<a href="../../uploads/<?php echo basename($image);?>"><img src="<?php echo $image;?>" alt=""></a>
<?php else:?>
	<img src="<?php echo $image;?>" alt="">
<?php endif;?>
<?php endforeach;?>
</body>
</html>