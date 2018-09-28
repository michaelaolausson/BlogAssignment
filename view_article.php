<!DOCTYPE html>
<?php 
	require_once "src/php/footer.php";
	require_once "src/php/article_service.php";
	$article_service = new ArticleService;
	$article = $article_service->getArticleById();
	$footer = new Footer;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Läs Artikel</title>
		<link rel="stylesheet" type="text/css" href="src/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header><h1>So... what's new?</h1></header>	
				<nav id='signed_in_nav'>
					<ul>
						<li><a href="index.php">Start</a></li>
						<li><a id="this_page" href="edit.php">Ny Artikel</a></li>
						<li><a href="overview.php">Översikt</a></li>
					</ul>
				</nav>
			<div class="container">
				<div class="divTop">
					<h2><?php echo $article['title']; ?></h2>
				</div>
			<div id="article_view">
			    <p><?php echo $article['content'];  ?></p>
			    <p id="author"><?php echo $article['signature']; ?></p>
			    <p id="date"><?php echo $article['timestamp']; ?></p>
			</div>
		</div>
			<?php $footer->create_footer(); ?>
	 </div> <!-- end of wrapper -->
	</body>
</html>