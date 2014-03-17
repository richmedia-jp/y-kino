<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>美容師編集</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/beautician.css">
	<link rel="stylesheet" type="text/css" href="../../css/edit.css">
</head>
<body>
	<div id="wrap">
	<header>
		<img src="ロゴ挿入">
	</header>
		<div id="contents">
			<div id="sidebar">
				<div id="menu">
					<p>menu</p>
				<ul>
					<li><a href="../beauty_salon/list.html"><img src="美容室一覧へのリンク">美容室</a></li>
					<li><a href="list.html"><img src="美容室一覧へのリンク">美容師</a></li>	
					<li><a href="../beauty_salon_tag/list.html"><img src="美容室タグ一覧へのリンク">美容室タグ</a></li>	
					<li><a href="../access_rank.html"><img src="アクセスランキング">アクセスランキング</a></li>	
				</ul>
				</div>
			</div>

			<div id="main">
			<ul id="items">
				<li class="name">名前</li>
				<li class="kana">名前（かな）</li>
				<li class="sex">性別</li>
				<li class="nickname">ニックネーム</li>
				<li class="beauty_salon">所属美容室</li>
				<li class="intro_text">紹介文</li>
				<li class="cut">得意なカット</li>
				<li class="image">画像</li>
				<li class="recommend">オススメフラグ </li>
			</ul>
			<form action= class="image""">
			<ul>
				<li class="name"><input class="last_name" type="text" name="last_name" size="10" maxlength="10" ><input type="text" name="first_name" size="10" maxlength="10" ></li>
				<li class="kana"><input class="last_name" type="text" name="last_name_kana" size="10" maxlength="10" ><input type="text" name="first_name_kana" size="10" maxlength="10" ></li>
				<li class="sex"><input type="radio" name="sex" value="man">男
				<input type="radio" name="sex" value="man">女</li>
				<li class="nickname"><input type="text" name="nickname" size="30" maxlength="30" ></li>
				<li class="beauty_salon"><select name="beauty_salon"></select></li>	
				<li class="intro_text"><textarea name="intro_text" cols="50" rows="5"></textarea></li>
				<li class="cut"><input type="text" name="cut" size="30" maxlength="30" ></li>
				<li class="image"><input type="file" name="beautician" size="30"></li>
				<li class="recommend"><input type="checkbox" name="recommend_flag" value=""></li>
			

			</ul>
			<input  type="submit" value="登録">
			</form>
			</div>
			</div>
			</div>
		</div>	
	</div>

</body>
