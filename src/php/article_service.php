<?php

require_once "mysqli.php";
/*
**
** Public Class, methods handles all things related to articles.
**
*/
class ArticleService {

	function __construct() {}
	/*
	** GET ALL ARTICLES FROM DATABASE
	*/
	private function get_articles($page = 0, $limit = 0) {

		$connection	= MySQLiHandler::connect();
		$offset 	= $page * $limit;
		$query 		= "";

		if (isset($connection) == TRUE) {

			// If $limit == 6 only 6 articles will be retrieved from the database. this happens on index page. index.php
			if ($limit == 6) {

				$query = "SELECT * FROM articles ORDER BY timestamp DESC LIMIT $offset,$limit";

			} else { // if $limit is default value 0, all articles will be retrieved. this happens on overview page. overview.php

				$query = "SELECT * FROM articles ORDER BY timestamp DESC";
			}

			$results 	= mysqli_query($connection, $query);

			$articles 	= array(); // array for article-results

			while($row = mysqli_fetch_assoc($results)) { // pushes every row in table to array $articles

					array_push($articles, $row);
			}
		}

		return $articles;
	}
	/*
	** Retrieves number of articles in database.
	*/ 
	public function getNumberOfArticles() {

		$connection	= MySQLiHandler::connect();

		if (isset($connection) == TRUE) { 

			$query = "SELECT COUNT(id) as total FROM articles";

		}

		$result = mysqli_query($connection, $query);
		$nrOfArticles = mysqli_fetch_assoc($result);

		return intval($nrOfArticles['total']);
	}
	/* 
	** Index-page article overview. 
	*/
	public function fill_article_container($page, $limit) {

		$articles = self::get_articles($page, $limit); 

		if (isset($articles)) {

			foreach ($articles as $article) {

				$title 		= $article['title'];
				$content 	= $article['content'];
				$content 	= substr($content,0,100) . "..."; //only shows part of content on index page.
				$category 	= $article['category'];
				$id 		= $article['id'];
				$timestamp	= $article['timestamp'];
				$signature	= $article['signature'];
				$timesign 	= $timestamp . " av " . $signature;
				

				$bottomDiv = "";
				
				if ($category == "Utbildning") {

					$bottomDiv = "<div class='articleBottom' id='articleBottom_edu'><h4>// $category</h4></div>";

					echo 
						"<div class='index_container'>
							<div id='articleTop_edu' class='articleTop'><h3>$title</h3><p class='timesign'>$timesign</p>
								<form method='post'>
									<input type='hidden' value='$id' name='article_id'>
									<button formaction='view_article.php' type='button class='read_more'>Läs Mer</button>
								</form>
							</div>
								<div class='articleDiv'>$content</div>
							$bottomDiv
						</div>
						";
				}
				if ($category == "Nöje") {

					$bottomDiv = "<div class='articleBottom' id='articleBottom_entertainment'><h4>// $category</h4></div>";

					echo 
						"<div class='index_container'>
							<div id='articleTop_entertainment' class='articleTop'><h3>$title</h3><p class='timesign'>$timesign</p>
								<form method='post'>
									<input type='hidden' value='$id' name='article_id'>
									<button formaction='view_article.php' type='button class='read_more'>Läs Mer</button>
								</form>
							</div>
								<div class='articleDiv'>$content</div>
							$bottomDiv
						</div>
						";
				}
				if ($category == "Sport") {

					$bottomDiv = "<div class='articleBottom' id='articleBottom_sport'><h4>// $category</h4></div>";

					echo 
						"<div class='index_container'>
							<div id='articleTop_sport' class='articleTop'><h3>$title</h3><p class='timesign'>$timesign</p>
								<form method='post'>
									<input type='hidden' value='$id' name='article_id'>
									<button formaction='view_article.php' type='button class='read_more'>Läs Mer</button>
								</form>
							</div>
								<div class='articleDiv'>$content</div>
							$bottomDiv
						</div>
						";
				}
			}
		}
	}
	/*
	** fills overviev-page (overview.php) with article titles.
	*/
	public function fill_overview() {

		$articles = self::get_articles();

		if (isset($articles)) {

			foreach($articles as $article) {

				$title 		= $article['title'];
				$category 	= $article['category'];
				$id 		= $article['id'];
				$timestamp	= $article['timestamp'];
				$signature	= $article['signature'];
				$timesign 	= $timestamp . " av " . $signature;

				if ($category == "Utbildning") {

					echo 
						"<div class='overview_container'>
								<div id='articleTop_edu' class='articleTop'>
									<a href='edit_existing.php?id=$id'?><h3>$title</h3></a>	
									<p class='timesign'>$timesign</p>
									<form method='post'>
										<input type='hidden' value='$id' name='article_id'>
										<button formaction='edit_existing.php' type='button class='read_more'>Redigera</button>
									</form>
								</div>
						</div>";
				}
				if ($category == "Nöje") {

					echo 
						"<div class='overview_container'>
								<div id='articleTop_entertainment' class='articleTop'>
									<a href='edit_existing.php?id=$id'?><h3>$title</h3></a>	
									<p class='timesign'>$timesign</p>
									<form method='post'>
										<input type='hidden' value='$id' name='article_id'>
										<button formaction='edit_existing.php' type='button class='read_more'>Redigera</button>
									</form>
								</div>
						</div>";
				}
				if ($category == "Sport") {

					echo 
						"<div class='overview_container'>
								<div id='articleTop_sport' class='articleTop'>
									<a href='edit_existing.php?id=$id'?><h3>$title</h3></a>	
									<p class='timesign'>$timesign</p>	
									<form method='post'>
										<input type='hidden' value='$id' name='article_id'>
										<button formaction='edit_existing.php' type='button class='read_more'>Redigera</button>
									</form>
								</div>
						</div>";
				}
			}
		}
	}
	/*
	** retrieves a specific article from db.
	** used by view_article.php to render full article
	** also used by edit_existing.php to edit full article
	*/
	public function getArticleById() {

		$connection = MySQLiHandler::connect();

		if (isset($_GET['id'])){

			$id = $_GET['id'];
		}
		if (isset($_POST['article_id'])) {

			$id = $_POST['article_id'];
		}
		if (isset($connection) == TRUE) {
			
			$query 		= "SELECT * FROM articles WHERE id = $id";
			$result 	= mysqli_query($connection, $query);
			$article 	= mysqli_fetch_assoc($result); // array for article-results

			return $article;
		}
	}
	/*
	** saves article to database.
	*/
	public function save_article() {

		$connection = MySQLiHandler::connect();

	    if (isset($connection) == TRUE) {

	    	if (isset($_POST)){

	    		session_start();

	    		$title 		= $_POST['title'];
				$category 	= $_POST['category'];
				$content 	= $_POST['content'];
		        $signature 	= $_SESSION['username'];
		        $query 		= "
					        	INSERT INTO articles (title, category, content, signature) 

					        	VALUES ('$title', '$category', '$content', '$signature')
					        	";
		        $result 	= $connection->query($query);

		        if (!$result) {echo "insert failed: $query<br>" . $connection->error . "<br>";}

	        	header("location: ../../overview.php"); // if succeded. 
	    	}
		
		}
	}
	/*
	** Updates existing article in database, via edit_existing.php and update_article.php
	*/
	public function update_article() {

		$connection = MySQLiHandler::connect();

		if (isset($connection) == TRUE) {

	    	if (isset($_POST)){

	    		session_start();

	    		$title 		= $_POST['title'];
				$category 	= $_POST['category'];
				$content 	= $_POST['content'];
				$id  		= $_POST['article_id'];
		        $signature 	= $_SESSION['username'];


		        $query  	= "UPDATE articles SET title='$title', category='$category', content='$content', signature='$signature' WHERE id='$id'";

		       if (mysqli_query($connection, $query)) {

    				header("location: ../../overview.php");
				} 

				else {
    			
    				echo "Ett fel uppstod vid uppdateringen: " . mysqli_error($connection);

					header("location: ../../edit_existing.php");
				}
			}
		}
	}
	/*
	** Deleteing article from database.
	*/
	public function delete_article() {

		$connection = MySQLiHandler::connect();
		$id  		= $_POST['article_id'];

		if (isset($connection) == TRUE) {

	    	if (isset($_POST)){

	    		$query  = "DELETE FROM articles WHERE id=$id";
	    	}

	    	if (mysqli_query($connection, $query)) {

    				header("location: ../../overview.php");
			} 

			else {
    			
    				echo "Ett fel uppstod vid uppdateringen: " . mysqli_error($connection);

					header("location: ../../edit_existing.php");
			}
	    }
	}
	/*
	** method for handling page content - editing article. edit_existing.php
	*/
	public function edit_article($article) {

		$title 		= $article['title'];
		$content 	= $article['content'];
		$category 	= $article['category'];
		$id 		= $article['id'];

		$radio_btns = "";

		if ($category == "Utbildning") {
		  	
		  	$radio_btns = 
		  					"<label>Utbildning</label><input class='radio_btn' type='radio' name='category' value='Utbildning' checked>
				    		
				    		<label>Nöje</label><input class='radio_btn' type='radio' name='category' value='Nöje'>
				    		
				    		<label>Sport</label><input class='radio_btn' type='radio' name='category' value='Sport'>";
		}

		if ($category == "Nöje") {
		  	
		  	$radio_btns = 
		  					"<label>Utbildning</label><input class='radio_btn' type='radio' name='category' value='Utbildning'>
				    		
				    		<label>Nöje</label><input class='radio_btn' type='radio' name='category' value='Nöje' checked>
				    		
				    		<label>Sport</label><input class='radio_btn' type='radio' name='category' value='Sport'>";
		  }
		  if ($category == "Sport") {
		  	
		  	$radio_btns = 
		  					"<label>Utbildning</label><input class='radio_btn' type='radio' name='category' value='Utbildning' >
				    		
				    		<label>Nöje</label><input class='radio_btn' type='radio' name='category' value='Nöje'>
				    		
				    		<label>Sport</label><input class='radio_btn' type='radio' name='category' value='Sport' checked>";
		}

		$form = <<<_END
			<div>
				<div class="divTop">
					<h2>Redigera Artikel</h2>
				</div>
				<div>
				<form class='article_form' method='post' action='edit.php' enctype='multipart/form-data'>

					<label>Titel</label><br><input type='text' name='title' value='$title' required><br>
					<label>Innehåll</label><br><textarea name='content' required>$content</textarea><br>
					<label>Kategori</label><br>

					    <div id='radioDiv'>

							$radio_btns

					    </div>

					<input type='hidden' name='article_id' value='$id'>

					<input class='submit' id='submitBtn' type='submit' value='Publicera Redigerad Artikel' formaction="src/php/update_article.php">
					<input class='submit' id='deleteBtn' type='submit' value='Radera Artikel*' formaction="src/php/delete_article.php">

					<p class='infotext'>*detta steg går inte att ångra</p>

				</form>
				</div>
			</div>
_END;

	echo $form;

	}
}
?>