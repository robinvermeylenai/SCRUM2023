<?php
// Entities/Client.php
declare(strict_types=1);

namespace Entities;

class Client
{

    private int $clientId;
    private Address $billingAddress;
    private Address $shippingAddress;


    public function __construct(int $clientId, Address $billingAddressId, Address $shippingAddressId)
    {
        $this->clientId = $clientId;
        $this->billingAddress = $billingAddressId;
        $this->shippingAddress = $shippingAddressId;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }
    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddressId($billingAddressId)
    {
        $this->billingAddress = $billingAddressId;

    }

    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    public function setShippingAddressId($shippingAddressId)
    {
        $this->shippingAddress = $shippingAddressId;
    }

}