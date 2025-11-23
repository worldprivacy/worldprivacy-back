<?php

namespace WorldPrivacy\Application\Service;

use WorldPrivacy\Domain\Model\Question\QuestionRepositoryInterface;
use WorldPrivacy\Domain\Model\Question\Question;

class GetRandomQuestionsService
{
    public function __construct(
        private QuestionRepositoryInterface $questionRepository
    ) {}

    /**
     * @return Question[]
     */
    public function execute(): array
    {
        return $this->questionRepository->findRandom(5);
    }
}
