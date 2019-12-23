<?php
	include 'db_config.php';

	$user_books = array();
	$user_id = 18410;
	$book_name_flag = false;
	$read_pages = 0;

	$errorMessage = "";
	if(isset($_POST["add"])){
		if(empty($_POST["title"])){
			$errorMessage = "タイトルが未入力です。";
		}
		else if(empty($_POST["genre"])){
			$errorMessage = "ジャンルが未入力です。";
		}
		else if(empty($_POST["page"])){
			$errorMessage = "ページ数が未入力です。";
		}

		if(!empty($_POST["title"]) && !empty($_POST["genre"]) && !empty($_POST["page"])){
			$title = $_POST["title"];
			$genre = $_POST["genre"];
			$page = $_POST["page"];

			try{
			// connect
			$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $db->query("SELECT * FROM books");
     		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($books as $p)
			{
				$book_name = $p['book_name'];

				if($book_name == $title)
				{
					$book_name_flag = true;
					break;
				}
			}
			if($book_name_flag == true;){
				$db->exec("INSERT INTO books(book_name, book_page, genre) VALUES({$title}, {$page}, {$genre})");
			}

			//recordテーブルに情報追加
			$db->exec("INSERT INTO records(user_id, book_id, read_pages) VALUES({$user_id}, {$book_id}, {$read_pages})");

			}
			$db = null;

			header("Location:books.php");  // メイン画面へ遷移
	        exit();  // 処理終了
		}
		catch(PDOException $e)
		{
			$errorMessage = 'データベースエラー';
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

	<div id="fh5co-contact">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>本の追加</h2>
				</div>
			</div>
		</div>
		<div class="container">
				<div class="row">
					<!--<div class="col-md-7 col-md-push-1 animate-box">-->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" id="title" name="title" class="form-control" placeholder="Book title">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" id="genre" name="genre" class="form-control" placeholder="Genre">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" id="page" name="page" class="form-control" placeholder="Book page">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" id="add" name="add" value="Add" class="btn btn-success">
								</div>
							</div>
							</div>
						<!--</div>-->
					</div>
				</div>
			</div>
	</div>
	</div>

	</body>
</html>
