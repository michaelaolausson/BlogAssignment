<?php

	include "article_service.php";
	$article_service = new ArticleService;
	$article_service->save_article();

	//ArticleService::save_article();

?>