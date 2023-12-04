<?php

declare(strict_types=1);

namespace Entities;

class OrderDetail
{
    private int $id;
    private int $orderId;
    private int $articleId;
    private int $quantityOrdered;
    private int $quantityCanceled;

    public function __construct(int $id, int $orderId, int $articleId, int $quantityOrdered, int $quantityCanceled)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->articleId = $articleId;
        $this->quantityOrdered = $quantityOrdered;
        $this->quantityCanceled = $quantityCanceled;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    public function setQuantityOrdered(int $quantityOrdered): void
    {
        $this->quantityOrdered = $quantityOrdered;
    }

    public function getQuantityCanceled(): int
    {
        return $this->quantityCanceled;
    }

    public function setQuantityCanceled(int $quantityCanceled): void
    {
        $this->quantityCanceled = $quantityCanceled;
    }
}

