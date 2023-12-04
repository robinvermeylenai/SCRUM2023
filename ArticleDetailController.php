<?php
declare(strict_types=1);

spl_autoload_register();


use Business\ArticleDetailService;

$artDetailServ = new ArticleDetailService();

$articleDetail = $artDetailServ->getArticleDetails((int) $_GET['productId']);