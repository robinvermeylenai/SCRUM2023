<?php

declare(strict_types=1);
spl_autoload_register();

use Business\ArticleDetailService;



/*----------------------reviews--------------------*/
/*ReviewDAO*/
print('-----ReviewDAO-----');
Print('<br>');

print('->getReviewsByArticleId()');
Print('<br><pre>');

$articleDetailService = new ArticleDetailService();
$articleDetail = $articleDetailService->getArticleDetails(33);

var_dump($articleDetail);
print('</pre><br>');

