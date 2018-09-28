<!DOCTYPE html>
<?php 
	require_once 'src/php/footer.php';
	require_once 'src/php/user_service.php';
	require_once 'src/php/article_service.php';
	User::authenticate_user();
	//$article = ArticleService::getArticleById();
	$article_service = new ArticleService;
	$article = $article_service->getArticleById();
	$footer = new Footer;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Redigera Artikel</title>
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
						<li><a href="edit.php">Ny Artikel</a></li>
						<li><a href="overview.php">Översikt</a></li>
					</ul>
				</nav>
		<div class="container">
			<?php  $article_service->edit_article($article); ?>
		</div>
			<?php $footer->create_footer_out(); ?>
		</div> <!-- end of wrapper -->
	</body>
</html>