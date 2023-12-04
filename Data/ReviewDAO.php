<?php

declare(strict_types=1);

namespace Data;


use Entities\Review;

class ReviewDAO extends BaseDAO
{
    public function getReviewsByArticleId(int $articleId): array
    {
        $dbh = $this->db_connect();

        $sql = "
            SELECT *
            FROM klantenReviews
            INNER JOIN bestellijnen ON klantenreviews.bestellijnId = bestellijnen.bestellijnId
            WHERE bestellijnen.artikelId = :articleId AND klantenReviewId IN (
                SELECT MAX(klantenReviewId)
                FROM klantenreviews
                GROUP BY nickname)
            ORDER BY score DESC, datum DESC;
        ";

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":articleId" => $articleId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);

        $reviews = array();

        foreach ($resultSet as $result) {
            $review = new Review(intval($result["klantenReviewId"]), $result["nickname"], intval($result["score"]), $result["commentaar"],
            $result["datum"], intval($result["bestellijnId"]));
            $reviews[] = $review;
        }

        $dbh = null;
        return $reviews;
    }
}