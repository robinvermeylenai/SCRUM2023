<?php

declare(strict_types=1);

namespace Entities;

class ActionCode
{
    private int $id;
    private string $name;
    private string $startDate;
    private string $expirationDate;
    private bool $singleUse;

    public function __construct(int $id, string $name, string $startDate, string $expirationDate, bool $singleUse)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startDate = $startDate;
        $this->expirationDate = $expirationDate;
        $this->singleUse = $singleUse;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getSingleUse(): bool
    {
        return $this->singleUse;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function setSingleUse(bool $singleUse): void
    {
        $this->singleUse = $singleUse;
    }
}