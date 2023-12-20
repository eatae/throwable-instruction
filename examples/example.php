<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Examples;

use eatae\ThrowableInstruction\Examples\Operations\EchoOperation;
use eatae\ThrowableInstruction\ThrowableInstruction;
use eatae\ThrowableInstruction\Operator;
use Exception;
use LogicException;

function operatorInCatch()
{
    try {
        $instruction = new ThrowableInstruction();
        $operation = new EchoOperation('Some output.');
        /*
         * Throwing an exception with an instruction
         */
        throw new LogicException('Some message.', 0, $instruction->add($operation));
    } catch (LogicException $e) {
        echo $e->getMessage();
        /*
         * Call instructions for a specified exception
         */
        Operator::followInstruction($e);
    }
}

function operatorInFinally()
{
    try {
        $instruction = new ThrowableInstruction();
        $operation = new EchoOperation('Some output.');
        /*
         * Throwing an exception with an instruction
         */
        throw new LogicException('Some message.', 0, $instruction->add($operation));
    } catch (LogicException $e) {
        echo $e->getMessage();
    } finally {
        /*
         * Call instructions for all exceptions
         */
        if (isset($e) && is_subclass_of($e, Exception::class)) {
            Operator::followInstruction($e);
        }
    }
}
