<?php
// Entities/Person.php
declare(strict_types=1);

namespace Entities;

class Person
{
    private Client $client;
    private string $firstName;
    private string $lastName;
    private UserAccount $userAccount;

    public function __construct(Client $client, string $firstName, string $lastName, UserAccount $userAccount)
    {
        $this->client = $client;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userAccount = $userAccount;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUserAccount(): ?UserAccount
    {
        return $this->userAccount;
    }


    
}