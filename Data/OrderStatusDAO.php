<?php

declare(strict_types = 1);

namespace Data;

use Entities\OrderStatus;

class OrderStatusDAO extends BaseDAO
{
    public function getAll(int $clientId): array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select bestellingsstatussen.bestellingsStatusId as id,bestellingen.bestellingsStatusId as OrderStatusId, bestellingsstatussen.naam as name, klanten.klantId as clientId from bestellingsstatussen, bestellingen, klanten where bestellingen.klantId = klanten.klantId and klanten.klantId = :cli";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':cli'=>$clientId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach ($resultSet as $row) {
            $orderStatus = new OrderStatus((int)$row["id"], (string)$row["name"] );
            array_push($list,$orderStatus);
        }
        $dbh = null;
        return $list;
    }

    public function getById(int $id): array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select bestellingsstatussen.bestellingsStatusId as id,bestellingen.bestellingsStatusId as OrderStatusId, bestellingen.bestelId as orderId, bestellingen.klantId as clientId_order klanten.klantId as clientId from bestellingen, bestellingslijnen, klanten where bestellingen.klantId = klanten.klantId and bestellingen.bestelId = :bes";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':bes'=>$id));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach ($resultSet as $row) {
            $orderStatus = new OrderStatus((int)$row["id"], (string)$row["name"] );
            array_push($list,$orderStatus);
        }
        $dbh = null;
        return $list;
    }

    public function add(OrderStatus $orderStatus): void
    {
        $sql = "INSERT  INTO bestellingsstatussen.naam  VALUES (?)";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([
            $orderStatus->getName(),
        ]);
    }

    public function update(OrderStatus $orderStatus): void
    {
        $sql = "UPDATE bestellingsstatussen SET bestellingsstatussen.naam = ? WHERE bestellingsstatussen.bestellingsStatusId = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([
            $orderStatus->getName(),
            $orderStatus->getStatusId(),
        ]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM bestellingsstatussen WHERE bestellingsstatussen.bestellingsStatusId = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}
