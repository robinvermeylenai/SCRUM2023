<?php

declare(strict_types=1);

namespace Entities;

class Article
{
    private int $id;
    private string $ean;
    private string $name;
    private string $description;
    private float $price;
    private int $weight;
    private int $stock;
    private int $deliveryTime;

    public function __construct(int $id, string $ean, string $name, string $description, float $price, int $weight, int $stock, int $deliveryTime)
    {
        $this->id = $id;
        $this->ean = $ean;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->weight = $weight;
        $this->stock = $stock;
        $this->deliveryTime = $deliveryTime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceInclusive(): float
    {
        return $this->price * 1.21;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getDeliveryTime(): int
    {
        return $this->deliveryTime;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEan(string $ean): void
    {
        $this->ean = $ean;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setDeliveryTime(int $deliveryTime): void
    {
        $this->deliveryTime = $deliveryTime;
    }
}