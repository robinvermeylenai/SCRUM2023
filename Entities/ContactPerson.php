<?php

declare(strict_types=1);
namespace Entities;

class ContactPerson
{
    private int $contactpersonId;
    private string $firstName;
    private string $lastName;
    private string $function;
    private Client $client;
    private UserAccount $userAccount;

    public function __construct(int $contactpersonId, string $firstName, string $lastName, string $function, Client $client, UserAccount $userAccount)
    {
        $this->contactpersonId = $contactpersonId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->function = $function;
        $this->client = $client;
        $this->userAccount = $userAccount;
    }

    public function getContactpersonId(): int 
    {
        return $this->contactpersonId;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }
    public function getFirstName(): string 
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setFunction(string $function): void
    {
       $this->function = $function; 
    }
    public function getFunction(): string
    {
        return $this->function;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function getUserAccount(): ?UserAccount
    {
        return $this->userAccount;
    }
}