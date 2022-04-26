<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction;

interface OperationInterface
{
    public function execute(): void;
}
