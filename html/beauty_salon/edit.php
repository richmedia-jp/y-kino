<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>美容室編集</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/beauty_salon.css">
	<link rel="stylesheet" type="text/css" href="../../css/edit.css">
</head>
<body>

<?php
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

	//画像１が正しく選択されているかチェック
	$salon_photo_name_1= null;
	if(!isset($_POST['salon_photo_name_1']) || !strlen($_POST['salon_photo_name_1'])){
		$errors['salon_photo_name_1'] = '画像を選択してください。';
	} else{
		$salon_photo_name_1 =$_POST['salon_photo_name_1'];
	}	

	//画像2が正しく選択されているかチェック
	$salon_photo_name_2= null;
	if(!isset($_POST['salon_photo_name_2']) || !strlen($_POST['salon_photo_name_2'])){
		$errors['salon_photo_name_2'] = '画像を選択してください。';
	} else{
		$salon_photo_name_2 =$_POST['salon_photo_name_2'];
	}

	//画像3が正しく選択されているかチェック
	$salon_photo_name_3= null;
	if(!isset($_POST['salon_photo_name_3']) || !strlen($_POST['salon_photo_name_3'])){
		$errors['salon_photo_name_3'] = '画像を選択してください。';
	} else{
		$salon_photo_name_3 =$_POST['salon_photo_name_3'];
	}

	//エラーがなければ保存
	if (count($errors) === 0){
		//保存するためのSQL文を作成
		$sql = "INSERT INTO `post`(`beauty_salon_name`,```address1`,`address2`,`tel`,`work_hour`,`intro_title`,`intro_text`,`salon_photo_name_1`,`salon_photo_name_2`,`salon_photo_name_3`) VALUES('"
			.mysql_real_escape_string($beauty_salon_name) ."','"
			.mysql_real_escape_string($address1) ."','"
			.mysql_real_escape_string($address2) ."','"
			.mysql_real_escape_string($tel) ."','"
			.mysql_real_escape_string($work_hour) ."','"
			.mysql_real_escape_string($intro_title) ."','"
			.mysql_real_escape_string($intro_text) ."','"
			.mysql_real_escape_string($salon_photo_name_1) ."','"
			.mysql_real_escape_string($salon_photo_name_2) ."','"
			.mysql_real_escape_string($salon_photo_name_3) ."','"
			.mysql_real_escape_string($address1) ."')";
	
		//保存する
		mysql_query($sql,$link);

		mysql_close($link);

		header('Location: http://' .$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI']);


	}


}



?>

	<div id="wrap">
	<header>
		<img src="ロゴ挿入">
	</header>
		<div id="contents">
			<div id="sidebar">
				<div id="menu">
					<p>menu</p>
				<ul>
					<li><a href="list.html"><img src="美容室一覧へのリンク">美容室</a></li>
					<li><a href="../beautician/list.html"><img src="美容室一覧へのリンク">美容師</a></li>	
					<li><a href="../beauty_salon_tag/list.html"><img src="美容室タグ一覧へのリンク">美容室タグ</a></li>	
					<li><a href="../access_rank.html"><img src="アクセスランキング">アクセスランキング</a></li>	
				</ul>
				</div>
			</div>

			<div id="main">
			<ul id="items">
				<li class="beauty_salon">美容室名</li>
				<li class="prefectual">所在地都道府県</li>
				<li class="address1">住所１</li>
				<li class="address2">住所２</li>
				<li class="tel">TEL</li>
				<li class="work_hour">営業時間</li>
				<li class="intro_title">紹介タイトル</li>
				<li class="intro_text">紹介本文</li>
				<li class="image1">店舗画像１</li>
				<li class="image2">店舗画像２</li>
				<li class="image3">店舗画像3</li>
				<li class="recommend">オススメフラグ</li>
				<li class="tag">登録タグ複数可</li>
			</ul>
			
			<form action="">
				<ul>
					<li class="beauty_salon"><input type="text" name="beauty_salon_name" size="30" maxlength="30"></li>
					<!--　都道府県を表示する-->
					<?php
					//データベースに接続する
					$link = mysql_connect('localhost','yukikino','yk19911010');

					if (!$link) {
					die('データベースに接続できません。'.mysql_error());
					}

					//データベースを選択する
					mysql_select_db('beauty_salon',$link);
					mysql_set_charset('utf8');

					$result = mysql_query('SELECT prefectual_name FROM prefectual_code');
					if (!$result) {
					die('クエリーが失敗しました。'.mysql_error());
					}

					// 内容を表示する
					echo "<select>";
					while ($row = mysql_fetch_assoc($result)) {
					echo "<option>{$row['prefectual_name']}</option>";
					}
					echo "</select>";

					// 接続を閉じる
					mysql_close($link);

						?>
					<li class="address1"><input type="text" name="address1" size="30" maxlength="30" ></li>
					<li class="address2"><input type="text" name="address2" size="30" maxlength="30" ></li>
					<li class="tel"><input type="text" name="tel" size="30" maxlength="30" ></li>
					<li class="work_hour"><input type="text" name="work_hour" size="30" maxlength="30" ></li>
					<li class="intro_text"><input type="text" name="intro_title" size="30" maxlength="30" ></li>
					<li class="intro_text"><textarea name="intro_text" cols="30" rows="5"></textarea></li>
					<li class="image1"><input type="file" name="beautician" size="30"></li>
					<li class="image_edit"><input type="checkbox" name="recommend_flag" value="">画像を削除する</li>
					<li class="image2"><input type="file" name="beautician" size="30"></li>
					<li class="image_edit"><input type="checkbox" name="recommend_flag" value="">画像を削除する</li>
					<li class="image3"><input type="file" name="beautician" size="30"></li>
					<li class="image_edit"><input type="checkbox" name="recommend_flag" value="">画像を削除する</li>
					<li class="recommend"><input type="checkbox" name="recommend_flag" value=""></li>
					<li class="tag"><select name="tag">
				</select><select name="tag">
				</select></li>
					
					
					


				</ul>


			</form>

				<li><input  type="submit" value="登録"></li>

			</div>
			</div>
		</div>	
	</div>

</body>
