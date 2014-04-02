<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>美容室登録</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
	<link rel="stylesheet" type="text/css" href="../../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../../css/beauty_salon.css">

</head>
<body>

<?php 
	require_once('config.php');?>
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
			
			<form action="upload.php" method="post"　 enctype="multipart/form-data">
				<ul>
					<li class="beauty_salon"><input type="text" name="beauty_salon_name" size="30" maxlength="30"></li>
					<!--　都道府県を表示する-->
				<?php
				

					// 内容を表示する
					echo "<select name='prefectual_id'>";
					while ($row = mysql_fetch_assoc($result)) {
					echo "<option value='{$row['prefectual_id']}'>{$row['prefectual_name']}</option>";
					}
					echo "</select>";


						?>				
					<li class="address1"><input type="text" name="address1" size="30" maxlength="30" ></li>
					<li class="address2"><input type="text" name="address2" size="30" maxlength="30" ></li>
					<li class="tel"><input type="text" name="tel" size="30" maxlength="30" ></li>
					<li class="work_hour"><input type="text" name="work_hour" size="30" maxlength="30" ></li>
					<li class="intro_text"><input type="text" name="intro_title" size="30" maxlength="30" ></li>
					<li class="intro_text"><textarea name="intro_text" cols="50" rows="5"></textarea></li>
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>">
					<li class="image1"><input type="file"  name="upfile[]" size="30"></li>
					<li class="image2"><input type="file" name="upfile[]" size="30"></li>
					<li class="image3"><input type="file" name="upfile[]" size="30"></li>
					<li class="recommend"><input type="checkbox" name="recommend_flag" value=""></li>
					<?php
			

					// 内容を表示する
					echo "<select name='beauty_salon_tag_id'>";
					while ($row2 = mysql_fetch_assoc($result2)) {
					echo 
					"<option value='{$row2['beauty_salon_tag_id']}'>
					{$row2['beauty_salon_tag']}
					</option>";
					}
					echo "</select>";
					
		

						?>			

		<li><input  type="submit" value="登録"></li>
				</ul>

		
			</form>


		<?php if (count($errors)):?>
				<ul class="error_list">
					<?php foreach ($errors as $error) :?>
					<li>
						<?php echo htmlspecialchars($error,ENT_QUOTES,'UTF-8')?>
					</li>	
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			</div>
			</div>
		</div>	
	</div>

</body>

