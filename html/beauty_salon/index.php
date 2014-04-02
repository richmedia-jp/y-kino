<?php 
require_once('config.php');
?>


<!DOCTYPE html>
<html lang = "ja">
<head>
	<meta charset ="UTF-8">
	
</head>
<body>
	
	<form action="file.php" method="post" enctype="multipart/form-data">
	<ul>
	<li class="image1"><input type="file"  name="upfile[]" size="30"></li>
	<li class="image1"><input type="file"  name="upfile[]" size="30"></li>
	<li class="image1"><input type="file"  name="upfile[]" size="30"></li>
	<li><input  type="submit" value="登録"></li>
	</ul>
	</form>

</body>