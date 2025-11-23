<?php

namespace WorldPrivacy\Domain\Model\Question;

interface QuestionRepositoryInterface
{
    /**
     * @param int $limit
     * @return Question[]
     */
    public function findRandom(int $limit): array;
}
