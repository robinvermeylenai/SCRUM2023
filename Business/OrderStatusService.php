<?php

declare(strict_types=1);

namespace Business;


use Data\OrderStatusDAO;

use Entities\OrderStatus;

class OrderStatusService
{
    private OrderStatusDAO $orderStatusDAO;

    public function __construct(OrderStatusDAO $orderStatusDAO)
    {
        $this->orderStatusDAO = $orderStatusDAO;
    }

    public function getAll(int $clientId): array
    {
        return $this->orderStatusDAO->getAll($clientId);
    }

    public function getById(int $id): array
    {
        return $this->orderStatusDAO->getById($id);
    }

    public function add(OrderStatus $orderStatus): void
    {
        $this->orderStatusDAO->add($orderStatus);
    }

    public function update(OrderStatus $orderStatus): void
    {
        $this->orderStatusDAO->update($orderStatus);
    }

    public function delete(int $id): void
    {
        $this->orderStatusDAO->delete($id);
    }
}