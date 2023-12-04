<?php

declare(strict_types=1);

namespace Entities;

class Review
{
    private int $id;
    private string $nickname;
    private int $score;
    private string $comment;
    private string $date;
    private int $orderDetailId;

    public function __construct(int $id, string $nickname, int $score, string $comment, string $date, int $orderDetailId)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->score = $score;
        $this->comment = $comment;
        $this->date = $date;
        $this->orderDetailId = $orderDetailId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getOrderDetailId(): int
    {
        return $this->orderDetailId;
    }

    public function setOrderDetailId(int $orderDetailId): void
    {
        $this->orderDetailId = $orderDetailId;
    }
}