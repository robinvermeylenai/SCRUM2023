<?php

declare(strict_types=1);

namespace Entities;

use Entities\Place;

class Address
{
    private int $addressId;
    private string $street;
    private string $number;
    private string $box;
    private Place $place;
    private bool $inUse;

    public function __construct(int $addressId, string $street, string $number, string $box = null, Place $place, bool $inUse)
    {
        $this->addressId = $addressId;
        $this->street = $street;
        $this->number = $number;
        $this->box = $box;
        $this->place = $place;
        $this->inUse = $inUse;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getBox(): string
    {
        return $this->box;
    }

    public function getPlace(): Place
    {
        return $this->place;
    }

    public function getInUse(): bool
    {
        return $this->inUse;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function setNumber(string $number)
    {
        $this->number = $number;
    }

    public function setBox(string $box)
    {
        $this->box = $box;
    }

    public function setPlace(Place $place)
    {
        $this->place = $place;
    }

    public function setInUse(bool $inUse)
    {
        $this->inUse = $inUse;
    }
}