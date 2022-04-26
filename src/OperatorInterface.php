<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction;

interface OperatorInterface
{
    public static function getInstruction(\Throwable $throwable): ?InstructionInterface;

    public static function followInstruction(\Throwable $throwable): void;
}
