<?php

declare(strict_types=1);

namespace Data;

use Entities\ActionCode;

class ActionCodeDAO extends BaseDAO
{
    public function getAllCodes() : array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = 'SELECT * FROM Actiecodes';
        $stmt = $dbh->prepare($sql);
        $result = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $actionCodes = array();
        foreach ($result as $row)
        {
            $actionCode = new ActionCode($row['actiecodeId'],$row['naam'],$row['geldigVanDatum'], $row['geldigTotDatum'], $row['isEenmalig'] );
            array_push($actionCodes, $actionCode );
        }
        $dbh = null;
        return $actionCodes;
    }
    public function addActionCode(ActionCode $actionCode): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = 'INSERT INTO Actiecodes (naam, geldigVanDatum, geldigTotDatum, isEenmalig) VALUES (:naam, :geldigVanDatum, :geldigTotDatum, :isEenmalig)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':naam', $actionCode->getName());
        $stmt->bindValue(':geldigVanDatum', $actionCode->getStartDate());
        $stmt->bindValue(':geldigTotDatum', $actionCode->getExpirationDate());
        $stmt->bindValue(':isEenmalig', $actionCode->getSingleUse(), \PDO::PARAM_BOOL);
        $stmt->execute();
        $dbh = null;
    }

    public function isActionCodeUsable(int $id): bool
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = 'SELECT COUNT(*) AS count FROM Actiecodes WHERE actiecodeId = :actiecodeId AND (isEenmalig = 0 OR (isEenmalig = 1 AND gebruikt = 0)) AND geldigVanDatum <= CURDATE() AND geldigTotDatum >= CURDATE()';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':actiecodeId', $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $count = $result['count'];
        $dbh = null;
        return ($count == 1);
    }

    public function updateActionCode(ActionCode $actionCode): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = 'UPDATE Actiecodes SET naam = :naam, geldigVanDatum = :geldigVanDatum, geldigTotDatum = :geldigTotDatum, isEenmalig = :isEenmalig WHERE actiecodeId = :actiecodeId';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':actiecodeId', $actionCode->getId());
        $stmt->bindValue(':naam', $actionCode->getName());
        $stmt->bindValue(':geldigVanDatum', $actionCode->getStartDate());
        $stmt->bindValue(':geldigTotDatum', $actionCode->getExpirationDate());
        $stmt->bindValue(':isEenmalig', $actionCode->getSingleUse(), \PDO::PARAM_BOOL);
        $stmt->execute();
        $dbh = null;
    }
}