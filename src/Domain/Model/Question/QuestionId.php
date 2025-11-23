<?php
namespace WorldPrivacy\Domain\Model\Question;

final class QuestionId
{
    public const PREFIX = "wp_question_";
    private string $id;

     public function __construct(?string $defautId = null)
    {
        $this->id = ($defautId === null) ?
            self::PREFIX . uniqid() :
            $defautId;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(QuestionId $id): bool
    {
        return $this->id == $id->id;
    }
}
