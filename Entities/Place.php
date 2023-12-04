<?php

declare(strict_types=1);

namespace Entities;

class Place
{
    private int $placeId;
    private int $zip;
    private string $name;

    public function __construct(int $placeId, int $zip, string $name)
    {
        $this->placeId = $placeId;
        $this->zip = $zip;
        $this->name = $name;
    }

    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    public function getZip(): int
    {
        return $this->zip;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPlaceId(int $placeId)
    {
        $this->placeId = $placeId;
    }

    public function setZip(int $zip)
    {
        $this->zip = $zip;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}