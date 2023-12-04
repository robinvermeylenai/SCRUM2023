<?php

declare(strict_types=1);

namespace Business;


use Data\OrderDetailDAO;

use Entities\OrderDetail;

class OrderDetailService
{
    private OrderDetailDAO $orderDetailDAO;

    public function __construct()
    {
        $this->orderDetailDAO = new OrderDetailDAO();
    }

    public function getById(OrderDetail $id): ?OrderDetail
    {
        return $this->orderDetailDAO->getById($id);
    }

    public function getAll(OrderDetail $orderId): array
    {
        return $this->orderDetailDAO->getAll($orderId);
    }
    public function create(OrderDetail $orderDetail): OrderDetail
    {
        return $this->orderDetailDAO->create($orderDetail);
    }

    public function update(OrderDetail $orderDetail): void
    {
        $this->orderDetailDAO->update($orderDetail);
    }

    public function delete(OrderDetail $id): void
    {
        $this->orderDetailDAO->delete($id);
    }
    public function getOrderDetailforCart(int $articleId, int $quantityOrdered): OrderDetail
    {
        return  new OrderDetail(0, 0, $articleId, $quantityOrdered, 0);
    }
}