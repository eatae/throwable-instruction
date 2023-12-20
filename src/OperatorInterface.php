<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction;

use Throwable;

interface OperatorInterface
{
    public static function followInstruction(Throwable $throwable): void;
}
