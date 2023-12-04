<?php

declare(strict_types=1);

namespace Entities;

class Category
{
    private int $id;
    private string $name;
    private ?int $parentId;

    public function __construct(int $id, string $name, ?int $parentId = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }
}