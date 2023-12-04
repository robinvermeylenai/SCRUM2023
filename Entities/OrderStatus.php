<?php

declare(strict_types=1);

namespace Entities;

class OrderStatus
{
    private int $id;
    private string $name;

    public function __construct(int $statusId, string $name)
    {
        $this->id = $statusId;
        $this->name = $name;
    }


    public function getStatusId(): int
    {
        return $this->id;
    }


    public function setStatusId(int $statusId): void
    {
        $this->id = $statusId;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
