<?php
	include 'db_config.php';
	require 'password.php';

	$users = array();

	try
	{
    	// connect＿データベースに接続
    	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    	// ユーザー情報一覧を取得
    	$stmt = $db->query("SELECT * FROM users");
    	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$db = null;
	}

	$db['host'] = "PDO_DSN";  // DBサーバのurl
	$db['user'] = "DB_USERNAME";
	$db['pass'] = "DB_PASSWORD";
	$db['dbname'] = "book_record";

	// エラーメッセージの初期化
 	$errorMessage = "";

	 // ログインボタンが押された場合
	if (isset($_POST["login"])) {
  		// １．ユーザIDの入力チェック
  		if (empty($_POST["userid"])) {
    	$errorMessage = "ユーザIDが未入力です。";
 		}
		else if (empty($_POST["password"])) {
    	$errorMessage = "パスワードが未入力です。";
  		}

		// ２．ユーザIDとパスワードが入力されていたら認証する
		if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
			// mysqlへの接続
		    $mysqli = new mysqli($db['host'], $db['user'], $db['pass']);
		    if ($mysqli->connect_errno) {
		      print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
		      exit();
		    }

		    // データベースの選択
		    $mysqli->select_db($db['dbname']);

		    // 入力値のサニタイズ
		    $userid = $mysqli->real_escape_string($_POST["userid"]);

		    // クエリの実行
		    $query = "SELECT * FROM users WHERE name = '" . $userid . "'";
		    $result = $mysqli->query($query);
		    if (!$result) {
		      print('クエリーが失敗しました。' . $mysqli->error);
		      $mysqli->close();
		      exit();
		    }

		    while ($row = $result->fetch_assoc()) {
		      // パスワード(暗号化済み）の取り出し
		      $db_hashed_pwd = $row['password'];
		    }

		    // データベースの切断
		    $mysqli->close();

		    // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
		    //if ($_POST["password"] == $pw) {
		    if (password_verify($_POST["password"], $db_hashed_pwd)) {
		      // ４．認証成功なら、セッションIDを新規に発行する
		      session_regenerate_id(true);
		      $_SESSION["USERID"] = $_POST["userid"];
		      header("Location: books.php");
		      exit;
	    	}
	    	else {
	      	// 認証失敗
	      	$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
	    	}
		}
		else {
	    // 未入力なら何もしない
		}
    }

	catch(PDOException $e)
	{
 	echo $e->getMessage();
	exit;
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
						<!--<ul>
							<li><a href="about.html">About</a></li>
							<li class="active"><a href="contact.html">Contact</a></li>
							<li class="btn-cta"><a href="#"><span>Login</span></a></li>
						</ul> -->
					</div>
				</div>

			</div>
		</div>
	</nav>

	<div id="fh5co-contact">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Login</h2>
				</div>
			</div>
		</div>
		<div class="container">
			<form id="loginForm" name="loginForm" action="" method="POST">
				<div class="row">
					<!--<div class="col-md-7 col-md-push-1 animate-box">-->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div><?php echo $errorMessage; ?></div>
									<label for="userid"></label><input type="text" id="userid" name="UserID" value="<?php echo htmlspecialchars($_POST["userid"], ENT_QUOTES); ?>" class="form-control" placeholder="UserID">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="password"></label><input type="password" id="password" name="Password" value="" class="form-control" placeholder="Password">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" id="login" value="Login" name="login" class="btn btn-success">
									</div>
								</div>
							</div>
							</div>
						<!--</div>-->
					</div>
				</div>
			</form>
			</div>
	</div>
	</div>
	</body>
</html>
