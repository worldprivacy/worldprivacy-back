<?php

namespace WorldPrivacy\Infrastructure\Api;

class ResponseData
{
    public function __construct(
        public readonly bool $success,
        public readonly ?\stdClass $data = null,
        public readonly string $error = "",
        public readonly string $error_message = ""
    ) {
    }
}
