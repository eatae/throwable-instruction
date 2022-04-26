<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction;

class Operator implements OperatorInterface
{
    /**
     * Get Instruction
     */
    public static function getInstruction(\Throwable $throwable): ?InstructionInterface
    {
        /** @var InstructionInterface|null $instruction */
        $instruction = null;
        if ($throwable instanceof InstructionInterface) {
            $instruction = $throwable;
        } elseif ($throwable->getPrevious() instanceof InstructionInterface) {
            $instruction = $throwable->getPrevious();
        }

        return $instruction;
    }

    /**
     * Follow Instruction
     */
    public static function followInstruction(\Throwable $throwable): void
    {
        $instruction = self::getInstruction($throwable);
        if ($instruction != null) {
            foreach ($instruction->getOperations() as $operation) {
                $operation->execute();
            }
        }
    }
}
