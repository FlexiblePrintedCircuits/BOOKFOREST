<?php
  include 'db_config.php';

  $records = array();
  $user_id = 18410;
  $book_id = 4;

  // エラーメッセージの初期化
	$errorMessage = "";
	// アップデートボタンが押された場合
	if (isset($_POST["update"])) {
	    // 1. 入力チェック
	    if (empty($_POST["pages_read"])) {  // emptyは値が空のとき
	        $errorMessage = 'ページ数が未入力です。';

	    if (!empty($_POST["pages_read"])) {
	        // 入力したユーザIDを格納
	        $page = $_POST["pages_read"];
	        // 2. ユーザIDとパスワードが入力されていたら認証する
	        // $dsn = sprintf("mysql: host='PDO_DSN'; dbname='book_record'; charset=utf8");
	        // エラー処理
	        try {
	            $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$db->exec("UPDATE records SET read_pages = {$page} WHERE user_id = {$user_id} AND book_id = {$book_id}");
				if($page => 300 and $page < 600)
				{
					$db->exec("UPDATE records SET read_pages = {$page} WHERE user_id = {$user_id} AND book_id = {$book_id}");
				}
	            header("Location:books.php");  // メイン画面へ遷移
				$db = null;
	            exit();  // 処理終了
	            }
			catch (PDOException $e) {
	            $errorMessage = 'データベースエラー';
	        }
	    }
	    }
	}
?>


<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<title>BOOK FOREST</title>

	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>

	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.html">BookForest</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
					</div>
				</div>

			</div>
		</div>
	</nav>

	<div class="container">
		<form actioin="">
			<div class="row">
				<h2>Python入門</h2>
				<div><?php echo $errorMessage; ?></div>
				<input type="text" id="pages_read" name="pages_read" class="form-control" placeholder="Number of pages read"><br>
			</div>
		</form>
		<div class="col-md-12">
			<div class="form-group">
				<input type="submit" id="update" name="update" value="Update" class="btn btn-success">
			</div>
		</div>
	</div>
	</div>
	</body>
</html>
