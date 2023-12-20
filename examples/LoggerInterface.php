<?php

namespace eatae\ThrowableInstruction\Examples;

interface LoggerInterface
{
    public function log(string $message, int $code = 0): void;
}
