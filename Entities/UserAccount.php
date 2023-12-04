<?php
// Entities/UserAccount.php
declare(strict_types=1);

namespace Entities;

class UserAccount
{

    private int $userAccountId;
    private string $email;
    private string $password;
    private bool $disabled;

    public function __construct(int $userAccountId, string $email, string $password, bool $disabled)
    {
        $this->userAccountId = $userAccountId;
        $this->email = $email;
        $this->password = $password;
        $this->disabled = $disabled;

    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail($email): void
    {
        $this->email = $email;

    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;

    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }


    public function setDisabled($disabled): void
    {
        $this->disabled = $disabled;
    }

    public function getUserAccountId(): int
    {
        return $this->userAccountId;
    }
}