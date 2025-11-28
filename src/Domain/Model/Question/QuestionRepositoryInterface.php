<?php

namespace WorldPrivacy\Domain\Model\Question;

interface QuestionRepositoryInterface
{
    public function add(Question $question): void;

    /**
     * @param int $limit
     * @return Question[]
     */
    public function findRandom(int $limit): array;
}
