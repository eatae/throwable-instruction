<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction;

interface InstructionInterface extends \Throwable
{
    public function add(OperationInterface ...$operations): self;

    /** @return OperationInterface[] */
    public function getOperations(): array;
}
