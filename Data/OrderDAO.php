<?php

declare(strict_types=1);

namespace Data;

use Entities\Order;

class OrderDAO extends BaseDAO
{
    public function getAll(int $clientId): array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select bestellingen.bestelId as id, bestellingen.besteldatum as orderdate, bestellingen.klantId as clientId, bestellingen.betaald as paid, bestellingen.betalingscode as paymentCode, bestellingen.betaalwijzeId as paymentMethodId, bestellingen.annulatie as cancelled, annulatiedatum as cancellationDate, bestellingen.terugbetalingscode as refundCode, bestellingen.bestellingsStatusId as orderStatusId, bestellingen.actiecodeGebruikt as promoCodeUsed, bestellingen.bedrijfsnaam as companyName, bestellingen.btwNummer as btwNumber, bestellingen.voornaam as firstName, bestellingen.familienaam as lastName, bestellingen.facturatieAdresId as billingAddressId, bestellingen.leveringsAdresId as shippingAddressId from bestellingen, klanten where bestellingen.klantId = klanten.klantId and klanten.klantId = :cli";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':cli'=>$clientId));
        $resultSet = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $list = array();
        foreach ($resultSet as $row)
        {
            $orders = new Order((int)$row["id"], (string)$row["orderdate"], (int)$row["clientId"], (bool)$row["paid"], (string)$row["paymentCode"], (int)$row["paymentMethodId"], (bool)$row["cancelled"], (string)$row["cancellationDate"], (string)$row["refundCode"], (int)$row["orderStatusId"], (bool)$row["promoCodeUsed"], (string)$row["companyName"], (string)$row["btwNumber"], (string)$row["firstName"], (string)$row["lastName"], (int)$row["billingAddressId"], (int)$row["shippingAddressId"]);
            array_push($list, $orders);
        }
        $dbh = null;
        return $list;

        }


    public function getById(int $id): ?array
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "select bestellingen.bestelId as id, bestellingen.besteldatum as orderdate, bestellingen.klantId as clientId, bestellingen.betaald as paid, bestellingen.betalingscode as paymentCode, bestellingen.betaalwijzeId as paymentMethodId, bestellingen.annulatie as cancelled, annulatiedatum as cancellationDate, bestellingen.terugbetalingscode as refundCode, bestellingen.bestellingsStatusId as orderStatusId, bestellingen.actiecodeGebruikt as promoCodeUsed, bestellingen.bedrijfsnaam as companyName, bestellingen.btwNummer as btwNumber, bestellingen.voornaam as firstName, bestellingen.familienaam as lastName, bestellingen.facturatieAdresId as billingAddressId, bestellingen.leveringsAdresId as shippingAddressId from bestellingen, klanten where bestellingen.klantId = klanten.klantId and bestellingen.klantId = :bes";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':bes'=>$id));
        $result = $stmt->fetchAll($dbh::FETCH_ASSOC);
        $idList = array();
        foreach ($result as $row)
        {
            $order = new Order((int)$row["id"], (string)$row["orderdate"], (int)$row["clientId"], (bool)$row["paid"], (string)$row["paymentCode"], (int)$row["paymentMethodId"], (bool)$row["cancelled"], (string)$row["cancellationDate"], (string)$row["refundCode"], (int)$row["orderStatusId"], (bool)$row["promoCodeUsed"], (string)$row["companyName"], (string)$row["btwNumber"], (string)$row["firstName"], (string)$row["lastName"], (int)$row["billingAddressId"], (int)$row["shippingAddressId"]);
            array_push($idList,$order);
        }
        $dbh = null;
        return $idList;

    }
    public function add(Order $order): Order
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "INSERT INTO bestellingen (bestellingen.besteldatum, bestellingen.klantId, bestellingen.betaald, bestellingen.betalingscode, bestellingen.betaalwijzeId, bestellingen.annulatie, bestellingen.annulatiedatum, 
        bestellingen.terugbetalingscode, bestellingen.bestellingsStatusId, bestellingen.actiecodeGebruikt, bestellingen.bedrijfsnaam, bestellingen.btwNummer, bestellingen.voornaam, bestellingen.familienaam, bestellingen.facturatieAdresId, bestellingen.leveringsAdresId) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $order->getOrderDate(),
            $order->getClientId(),
            $order->isPaid(),
            $order->getPaymentCode(),
            $order->getPaymentMethodId(),
            $order->isCancelled(),
            $order->getCancellationDate(),
            $order->getRefundCode(),
            $order->getOrderStatusId(),
            $order->isPromoCodeUsed(),
            $order->getCompanyName(),
            $order->getBtwNumber(),
            $order->getFirstName(),
            $order->getLastName(),
            $order->getBillingAddressId(),
            $order->getShippingAddressId()
        ]);
        $id = $dbh->lastInsertId();
        $order->setId((int)$id);
        $dbh = null;
        return $order;
    }

    public function update(Order $order): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "UPDATE bestellingen SET bestellingen.klantId = ?, bestellingen.besteldatum = ?, bestellingen.bestelStatusId = ?, bestellingen.betaalwijzeId = ? WHERE bestellingen.bestelId = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $order->getClientId(),
            $order->getOrderDate(),
            $order->getOrderStatusId(),
            $order->getPaymentMethodId(),
            $order->getId()
        ]);
        $dbh = null;
    }

    public function delete(Order $order): void
    {
        $baseDAO = new BaseDAO();
        $dbh = $baseDAO->db_connect();
        $sql = "DELETE * FROM bestellingen WHERE bestellingen.bestelId = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $order->getId()
        ]);
        $dbh = null;
    }
}