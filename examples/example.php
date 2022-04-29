<?php

declare(strict_types=1);

use Eatae\ThrowableInstruction\ThrowableInstruction;
use Eatae\ThrowableInstruction\Examples\EchoOperation;
use Eatae\ThrowableInstruction\Operator;

try {
    throw new Exception(
        "Example message",
        0,
        (new ThrowableInstruction())->add(new EchoOperation(1))
    );
} catch (Exception $e) {
    // some action
    echo $e->getMessage();
    // run instruction
    Operator::followInstruction($e);
}
