<?php

declare(strict_types=1);
namespace Entities;

class FaqItem {
    private int $id;
    private int $articleId;
    private string $question;
    private string $answer;

    public function __construct(int $id, int $articleId, string $question, string $answer)
    {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }
    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }
    public function getAnswer(): string
    {
        return $this->answer;
    }
}
