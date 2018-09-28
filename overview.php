<!DOCTYPE html>
<?php 
	require_once "src/php/footer.php";
	require_once "src/php/article_service.php";
	require_once "src/php/user_service.php";
	$article_service = new ArticleService;
	$footer = new Footer;
	User::authenticate_user();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Översikt</title>
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
						<li><a id="this_page" href="overview.php">Översikt</a></li>
					</ul>
				</nav>

			<?php $article_service->fill_overview(); ?>

			<?php $footer->create_footer_out(); ?>

	 	</div> <!-- end of wrapper -->
	</body>
</html>