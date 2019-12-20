<!--< ?php
	include 'db_config.php';

	$user_books = array();

	try
	{
	 // connect
	 $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	 $stmt = $db->query("select * from users WHERE user_ID={$_GET['user_ID']}");
	 $user_books = $stmt->fetch(PDO::FETCH_ASSOC);

	 $id = $product['id'];
	 $name = $product['name'];
	 $unit_price = $product['unit_price'];
	 $stock_quantity = $product['stock_quantity'];

	 $db = null;
	}
	catch(PDOException $e)
	{
	echo $e->getMessage();
	exit;
	}
? >-->


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
						<form action="genre.html">
							<input type="submit" value="Number of pages by genre" class="btn btn-success">
						</form>
						<form action="ranking.php">
							<input type="submit" value="Ranking" class="btn btn-success">
						</form>
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
					<h2>All Books</h2>
				</div>
			</div>
		</div>

		<div class="container">
			<form action="add.html">
				<input type="submit" value="Add a book" class="btn btn-success">
			</form>
				<div class="row">
					<!--<div class="col-md-7 col-md-push-1 animate-box">-->
        			  <div class="user-frame">
        				  <h2>Python入門</h2>
        				  <p>ページ数：52ページ</p>
                	  <form action="update.html">
				  		  <button class="btn btn-success" href="#">Update</button>
					  </form>
        			  </div>
                <div class="user-frame">
        				  <h2>羅生門</h2>
        				  <p>ページ数：131ページ</p>
                  <button class="btn btn-success" href="#">Update</button>
        			  </div>
                <div class="user-frame">
        				  <h2>吾輩は猫である</h2>
        				  <p>ページ数：156ページ</p>
                  <button class="btn btn-success" href="#">Update</button>
        			  </div>
                <div class="user-frame">
        				  <h2>資本論</h2>
        				  <p>ページ数：311ページ</p>
                  <button class="btn btn-success" href="#">Update</button>
        			  </div>
        			</div>
        		</div>
        	</div>
	</div>
	</div>

	</body>
</html>
