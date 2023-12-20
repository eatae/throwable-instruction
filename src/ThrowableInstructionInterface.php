<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction;

use Throwable;

interface ThrowableInstructionInterface extends Throwable
{
    public function add(OperationInterface ...$operations): self;

    /** @param mixed[] $parameters */
    public function operation(string $class, iterable $parameters = []): self;

    /** @return OperationInterface[] */
    public function getOperations(): array;

    public function clean(): void;
}
