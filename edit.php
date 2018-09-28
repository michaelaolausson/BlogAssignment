<!DOCTYPE html>
<?php 
	require_once 'src/php/footer.php';
	require_once 'src/php/user_service.php';
	User::authenticate_user();
	$footer = new Footer;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Skriv En Ny Artikel</title>
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
				<h2>Ny Artikel</h2>
			</div>
			<div>
			    <form class='article_form' method='post' action='edit.php' enctype='multipart/form-data'>
				   	<label>Titel</label><br><input type='text' name='title' required><br>
				   	<label>Innehåll</label><br><textarea name='content' required></textarea><br>
				   	<label>Kategori</label><br>
				    	<div id='radioDiv'>
				    		<label>Utbildning</label><input class='radio_btn' type='radio' name='category' value='Utbildning'>
				    		<label>Nöje</label><input class='radio_btn' type='radio' name='category' value='Nöje'>
				    		<label>Sport</label><input class='radio_btn' type='radio' name='category' value='Sport'>
				    	</div>	
				    <input class='submit' id='submitBtn' type='submit' value='Publicera Artikel' formaction="src/php/publish.php">
			    </form>
			</div>
		</div>
			<?php $footer->create_footer_out(); ?>
		</div> <!-- end of wrapper -->
	</body>
</html>