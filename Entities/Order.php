<?php

declare(strict_types=1);

namespace Entities;

class Order
{
    private int $id;
    private string $orderDate;
    private int $clientId;
    private bool $paid;
    private string $paymentCode;
    private int $paymentMethodId;
    private bool $cancelled;
    private string $cancellationDate;
    private string $refundCode;
    private int $orderStatusId;
    private bool $promoCodeUsed;
    private string $companyName;
    private string $btwNumber;
    private string $firstName;
    private string $lastName;
    private int $billingAddressId;
    private int $shippingAddressId;

    public function __construct(int $id, string $orderDate, int $clientId, bool $paid, string $paymentCode, int $paymentMethodId, bool $cancelled, string $cancellationDate, string $refundCode, int $orderStatusId, bool $promoCodeUsed, string $companyName, string $btwNumber, string $firstName, string $lastName, int $billingAddressId, int $shippingAddressId)
    {
        $this->id = $id;
        $this->orderDate = $orderDate;
        $this->clientId = $clientId;
        $this->paid = $paid;
        $this->paymentCode = $paymentCode;
        $this->paymentMethodId = $paymentMethodId;
        $this->cancelled = $cancelled;
        $this->cancellationDate = $cancellationDate;
        $this->refundCode = $refundCode;
        $this->orderStatusId = $orderStatusId;
        $this->promoCodeUsed = $promoCodeUsed;
        $this->companyName = $companyName;
        $this->btwNumber = $btwNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->billingAddressId = $billingAddressId;
        $this->shippingAddressId = $shippingAddressId;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getOrderDate(): string
    {
        return $this->orderDate;
    }


    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }


    public function getClientId(): int
    {
        return $this->clientId;
    }


    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }


    public function isPaid(): bool
    {
        return $this->paid;
    }


    public function setPaid(bool $paid): void
    {
        $this->paid = $paid;
    }


    public function getPaymentCode(): string
    {
        return $this->paymentCode;
    }


    public function setPaymentCode(string $paymentCode): void
    {
        $this->paymentCode = $paymentCode;
    }


    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }


    public function setPaymentMethodId(int $paymentMethodId): void
    {
        $this->paymentMethodId = $paymentMethodId;
    }


    public function isCancelled(): bool
    {
        return $this->cancelled;
    }


    public function setCancelled(bool $cancelled): void
    {
        $this->cancelled = $cancelled;
    }


    public function getCancellationDate(): string
    {
        return $this->cancellationDate;
    }


    public function setCancellationDate(string $cancellationDate): void
    {
        $this->cancellationDate = $cancellationDate;
    }


    public function getRefundCode(): string
    {
        return $this->refundCode;
    }


    public function setRefundCode(string $refundCode): void
    {
        $this->refundCode = $refundCode;
    }


    public function getOrderStatusId(): int
    {
        return $this->orderStatusId;
    }


    public function setOrderStatusId(int $orderStatusId): void
    {
        $this->orderStatusId = $orderStatusId;
    }


    public function isPromoCodeUsed(): bool
    {
        return $this->promoCodeUsed;
    }


    public function setPromoCodeUsed(bool $promoCodeUsed): void
    {
        $this->promoCodeUsed = $promoCodeUsed;
    }


    public function getCompanyName(): string
    {
        return $this->companyName;
    }


    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }


    public function getBtwNumber(): string
    {
        return $this->btwNumber;
    }


    public function setBtwNumber(string $btwNumber): void
    {
        $this->btwNumber = $btwNumber;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }


    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }


    public function getLastName(): string
    {
        return $this->lastName;
    }


    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }


    public function getBillingAddressId(): int
    {
        return $this->billingAddressId;
    }


    public function setBillingAddressId(int $billingAddressId): void
    {
        $this->billingAddressId = $billingAddressId;
    }


    public function getShippingAddressId(): int
    {
        return $this->shippingAddressId;
    }


    public function setShippingAddressId(int $shippingAddressId): void
    {
        $this->shippingAddressId = $shippingAddressId;
    }

}

