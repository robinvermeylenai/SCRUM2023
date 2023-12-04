<?php
// Entities/Company.php
declare(strict_types=1);

namespace Entities;

class Company
{
    private Client $client;
    private string $companyName;
    private string $btwNumber;
    public function __construct(Client $client, string $companyName, string $btwNumber)
    {
        $this->client = $client;
        $this->companyName = $companyName;
        $this->btwNumber = $btwNumber;
    }


    public function getClientId(): ?Client
    {
        return $this->client;
    }


    public function getCompanyName(): string
    {
        return $this->companyName;
    }


    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName;


    }

    public function getBtwNumber(): string
    {
        return $this->btwNumber;
    }

    public function setBtwNumber($btwNumber): void
    {
        $this->btwNumber = $btwNumber;

    }
}