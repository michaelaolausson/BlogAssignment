<!DOCTYPE html>
<?php 
	require_once "src/php/footer.php";
	require_once "src/php/article_service.php";
	$article_service = new ArticleService;
	$footer = new Footer;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Start</title>
		<link rel="stylesheet" type="text/css" href="src/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header><h1>So... what's new?</h1></header>	
			<nav id='signed_in_nav'>
				<ul>
					<li><a id="this_page" href="index.php">Start</a></li>
					<li><a href="edit.php">Ny Artikel</a></li>
					<li><a href="overview.php">Översikt</a></li>
				</ul>
			</nav>
			<?php 

				$nrOfArticles = $article_service->getNumberOfArticles();

				$page = 0;

				if(isset($_GET['page'])) {

					$page = $_GET['page'];

					if($page < 0) {

						$page = 0;
					}
				}

				$backBtnClass = "back_btn";
				$forwardBtnClass = "forward_btn";
				$numberOfPages = ceil($nrOfArticles / 6);
				$currentPage = $page+1;

				if($page == 0) {

					$backBtnClass = "back_btn_disabled";
				}

				$showMoreArticles = $nrOfArticles / (($page+1) * 6);

				if($showMoreArticles < 1) {

					$forwardBtnClass = "forward_btn_disabled";
				}

				$article_service->fill_article_container($page, 6);
			?>
			<nav id="index_nav">
				<ul>
					<li><a class="<?=$backBtnClass?>" href="index.php?page=<?=$page-1 ?>">&#9756;</a></li>
					<li><a class="<?=$forwardBtnClass?>" href="index.php?page=<?=$page+1 ?>">&#9758;</a></li>
				</ul>
				<p class='pageNumber'><?php echo "sida ". $currentPage . " av " . $numberOfPages;?></p>
			</nav>
			<?php 
					$footer->create_footer();
					//$article_service->getNumberOfArticles(); 
			?>
		</div> <!-- end of wrapper -->
	</body>
</html>