<?php
  include 'db_config.php';

  $users = array();

  $new_user_color = '灰';
  $new_user_total_page = 0;

  try
  {
     // connect＿データベースに接続
     $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


     // ユーザー情報一覧を取得
     $stmt = $db->query("SELECT * FROM users");
     $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

	 // ユーザー追加
	 $db->exec("INSERT INTO users(user_id, name, password, color, total_page) VALUES({$new_user_ID}, '{$new_user_name}', '{$new_password}', '{$new_user_color}', {$new_user_total_page})");

     $db = null;
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
					</div>
				</div>

			</div>
		</div>
	</nav>

	<div id="fh5co-contact">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>登録</h2>
				</div>
			</div>
		</div>
		<div class="container">
				<div class="row">
					<!--<div class="col-md-7 col-md-push-1 animate-box">-->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Name">
									<input name="new_user_name" type="hidden" value="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="UserID">
									<input name="new_user_ID" type="hidden" value="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Password">
									<input name="new_password" type="hidden" value="">
								</div>
							</div>
							<form action="login.php">
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" value="Login" class="btn btn-success">
									</div>
								</div>
							</form>
							</div>
						<!--</div>-->
					</div>
				</div>
			</div>
	</div>
	</div>

	</body>
</html>
