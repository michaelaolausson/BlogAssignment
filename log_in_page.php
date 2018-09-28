<!DOCTYPE html>
<?php 
	require_once "src/php/footer.php";
	require_once "src/php/user_service.php";
	$u = new User;
	$footer = new Footer;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>So... What's new? | Log In</title>
		<link rel="stylesheet" type="text/css" href="src/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header><h1>So... what's new?</h1></header>	
			<div class="container">
				<div id="log_in_div">
					<form id="log_in_form" method="post" enctype="multipart/form-data" action="edit.php">
						Användarnamn<br>
							<input type="text" name="username"><br>
						Lösenord<br>
							<input type="text" name="password"><br>
							<input id="log_in_submit" type="submit" value="LOGGA IN" formaction="log_in_page.php">
					</form>
				</div>
			</div>
			<nav>
				<ul>
					<li><a class="back_btn" href="index.php">&#9756;</a></li>
				</ul>
			</nav>
				<?php $footer->create_footer(); ?>
		</div> <!-- end of wrapper -->
	</body>
</html>