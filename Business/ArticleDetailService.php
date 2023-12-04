<?php

declare(strict_types=1);

namespace Business;

use Business\ArticleService;
use Data\ArticleDAO;
use Data\ReviewDAO;

class ArticleDetailService extends ArticleService
{
    public function getArticleDetails(int $articleId): array
    {
        $articleDAO = new ArticleDAO();
        $reviewDAO = new ReviewDAO();

        $article = $articleDAO->getById($articleId);
        $reviews = $reviewDAO->getReviewsByArticleId($articleId);

        $sumScore = 0;
        $avgScore = 0;

        if (count($reviews) > 0) {
            foreach ($reviews as $review) {
                $sumScore += $review->getScore();
            }
            $avgScore = $sumScore / count($reviews);
        }

        $articleDetails = array('article'=>$article, 'review'=>$reviews, 'avgScore'=>$avgScore);

        return $articleDetails;
    }
}