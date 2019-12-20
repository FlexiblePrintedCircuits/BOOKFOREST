<?php
  include 'db_config.php';

  $products = array();

  try
  {
     // connect＿データベースに接続
     $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


     // 商品一覧を取得
     $stmt = $db->query("SELECT * FROM users ORDER BY total_pages DESC");
     $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
					<h2>Ranking</h2>
				</div>
			</div>
		</div>
		<div class="container">
				<div class="row">
          <table>
            <tr>
              <th>順位</th>
              <th>ユーザ名</th>
              <th>累積ページ数</th>
              <th>色</th>
            </tr>
            <!--<tr>
              <td>1位</td>
              <td>yugehayata</td>
              <td>34212</td>
              <td>赤</td>
            </tr>
            <tr>
              <td>2位</td>
              <td>kinoshita</td>
              <td>23521</td>
              <td>赤</td>
            </tr>
            <tr>
              <td>3位</td>
              <td>anzai</td>
              <td>21542</td>
              <td>赤</td>
            </tr>
            <tr>
              <td>4位</td>
              <td>chiachia</td>
              <td>15421</td>
              <td>赤</td>
            </tr>-->
            <?php
              $i = 0;
              foreach($users as $p)
              {
                $id = $p['id'];
                $name = $p['name'];
                $color = $p['color'];
                $pages = $p['total_pages'];
                $i+=1;

                echo "<tr><td>{$i}</td><td>{$name}</td><td>{$pages}</td><td>{$color}</td><tr>";
              }
             ?>
          </table>
					</div>
				</div>
			</div>
	</div>
	</div>

	</body>
</html>
