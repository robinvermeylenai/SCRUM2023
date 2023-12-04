<?php

declare(strict_types=1);



namespace Business;


use Data\AddressDAO;
use Entities\Address;
use Entities\Place;

class AddressService
{
    private AddressDAO $addressDAO;

    public function __construct()
    {
        $this->addressDAO = new AddressDAO;
    }

    public function getAddressByAddressId(int $id): ?Address
    {
        return $this->addressDAO->getAddressByAdressId($id);
    }

    public function existAddress(string $street, string $number, string $box, Place $place): ?Address
    {
        return $this->addressDAO->existAddress($street, $number, $box, $place);
    }

    public function createNewAddress(string $street, string $number, ?string $box, Place $place): ?Address
    {
        return $this->addressDAO->insertNewAddress($street, $number, $box, $place);
    }
}
