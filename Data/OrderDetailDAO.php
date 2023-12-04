<?php

declare(strict_types=1);

namespace Data;


use Entities\OrderDetail;

class OrderDetailDAO extends BaseDAO
{
    private function createOrderDetailFromData(array $data): OrderDetail
    {
        return new OrderDetail(
            (int)$data['id'],
            (int)$data['bestelId'],
            (int)$data['artikelId'],
            (int)$data['aantalBesteld'],
            (int)$data['aantalGeannuleerd']
        );
    }

    public function getById(OrderDetail $id): ?OrderDetail
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "SELECT * FROM bestellijnen WHERE bestellijnen.bestellijnId= ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id->getId()]);
        $result = $stmt->fetch($dbh::FETCH_ASSOC);
        $dbh = null;
        return $result ? $this->createOrderDetailFromData($result) : null;

    }

    public function getAll(OrderDetail $orderId): array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "SELECT * FROM bestellijnen where bestellijnen.bestelId = bestellingen.bestelId and bestellingen.bestelId = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$orderId->getOrderId()]);
        $results = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach ($results as $row)
        {
            $orderDetail = new OrderDetail((int)$row["bestellijnId"], (int)$row["bestelId"], (int)$row["artikelId"], (int)$row["aantalBesteld"], (int)$row["aantalGeannuleerd"]);
            array_push($list, $orderDetail);
        }
        $dbh = null;
        return $list;
    }
    public function create(OrderDetail $orderDetail): OrderDetail
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "INSERT INTO bestellijnen (bestellijnen.bestelId, bestellijnen.artikelId, bestellijnen.aantalBesteld, bestellijnen.aantalGeannuleerd) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $orderDetail->getOrderId(),
            $orderDetail->getArticleId(),
            $orderDetail->getQuantityOrdered(),
            $orderDetail->getQuantityCanceled()
        ]);
        $id = $dbh->lastInsertId();
        $orderDetail->setId((int)$id);
        $dbh = null;
        return $orderDetail;
    }

    public function update(OrderDetail $orderDetail): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "UPDATE bestellijnen SET bestellijnen.bestelId = ?, bestellijnen.artikelId = ?, bestellijnen.aantalBesteld = ?, bestellijnen.aantalGeannuleerd = ? WHERE bestellijnen.bestellijnId = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $orderDetail->getOrderId(),
            $orderDetail->getArticleId(),
            $orderDetail->getQuantityOrdered(),
            $orderDetail->getQuantityCanceled(),
            $orderDetail->getId()
        ]);
        $dbh = null;
    }

    public function delete(OrderDetail $id): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "DELETE * FROM bestellijnen WHERE bestellijnen.bestelId = bestellingen.bestelId and bestellingen.bestelId = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id->getOrderId()]);
        $dbh = null;
    }

}