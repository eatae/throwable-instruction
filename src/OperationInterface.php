<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction;

interface OperationInterface
{
    public function execute(): void;
}
