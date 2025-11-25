<?php

namespace WorldPrivacy\Domain\Model\Question;

class Question
{
    private \DateTime $createdAt;

    public function __construct(
        private string $intitule,
        private bool $reponse,
        private string $texteVrai,
        private string $texteFaux,
        private QuestionId $questionId = new QuestionId(),
        ?\DateTime $createdAt = null
    ) {
        $this->createdAt = $createdAt ?? new \DateTime();
    }


    public function getQuestionId(): QuestionId
    {
        return $this->questionId;
    }

    public function getIntitule(): string
    {
        return $this->intitule;
    }

    public function getReponse(): bool
    {
        return $this->reponse;
    }

    public function getTexteVrai(): string
    {
        return $this->texteVrai;
    }

    public function getTexteFaux(): string
    {
        return $this->texteFaux;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
