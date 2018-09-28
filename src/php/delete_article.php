<?php

	require_once "article_service.php";
	$article_service = new ArticleService;
	$article_service->delete_article();

	//ArticleService::delete_article();

?>