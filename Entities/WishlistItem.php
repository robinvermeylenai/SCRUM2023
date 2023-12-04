<?php

declare(strict_types=1);

namespace Entities;

class WishlistItem
{
    private int $id;
    private int $articleId;
    private int $userAccountId;
    private string $requestDate;
    private int $amount;
    private string $emailSentDate;

    public function __construct(int $articleId, int $userAccountId, string $requestDate, int $amount, string $emailSentDate)
    {
        $this->articleId = $articleId;
        $this->userAccountId = $userAccountId;
        $this->requestDate = $requestDate;
        $this->amount = $amount;
        $this->emailSentDate = $emailSentDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function getUserAccountId(): int
    {
        return $this->userAccountId;
    }

    public function setUserAccountId(int $userAccountId): void
    {
        $this->userAccountId = $userAccountId;
    }

    public function getRequestDate(): string
    {
        return $this->requestDate;
    }

    public function setRequestDate(string $requestDate): void
    {
        $this->requestDate = $requestDate;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getEmailSentDate(): string
    {
        return $this->emailSentDate;
    }

    public function setEmailSentDate(?string $emailSentDate): void
    {
        $this->emailSentDate = $emailSentDate;
    }
}
