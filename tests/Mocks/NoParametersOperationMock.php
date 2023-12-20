<?php

declare(strict_types=1);

namespace eatae\ThrowableInstruction\Tests\Mocks;

use eatae\ThrowableInstruction\OperationInterface;

class NoParametersOperationMock implements OperationInterface
{
    public function execute(): void
    {
        echo "no parameters";
    }
}
