<?php

declare(strict_types=1);

namespace Business;

use Data\OrderDAO;

use Entities\Order;

class OrderService
{
    private OrderDAO $orderDAO;

    public function __construct()
    {
        $this->orderDAO = new OrderDAO();
    }

    public function getById(int $id): array
    {
        return $this->orderDAO->getById($id);
    }

    public function getAll(int $clientId): array
    {
        return $this->orderDAO->getAll($clientId);
    }

    public function add(Order $order): Order
    {
        return $this->orderDAO->add($order);
    }

    public function update(Order $order): void
    {
        $this->orderDAO->update($order);
    }

    public function delete(Order $order): void
    {
        $this->orderDAO->delete($order);
    }
}
