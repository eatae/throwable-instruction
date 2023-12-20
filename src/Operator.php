<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction;

use Throwable;

class Operator implements OperatorInterface
{

    public static function getInstruction(Throwable $throwable): ?ThrowableInstructionInterface
    {
        /** @var ThrowableInstructionInterface|null $instruction */
        $instruction = null;
        if ($throwable instanceof ThrowableInstructionInterface) {
            $instruction = $throwable;
        } elseif ($throwable->getPrevious() instanceof ThrowableInstructionInterface) {
            $instruction = $throwable->getPrevious();
        }

        return $instruction;
    }

    public static function followInstruction(Throwable $throwable): void
    {
        $instruction = self::getInstruction($throwable);
        if ($instruction != null) {
            foreach ($instruction->getOperations() as $operation) {
                $operation->execute();
            }
            $instruction->clean();
        }
    }
}
