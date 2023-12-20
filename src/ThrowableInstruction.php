<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction;

use Exception;

class ThrowableInstruction extends Exception implements ThrowableInstructionInterface
{
    /** @var OperationInterface[] */
    protected array $operations = [];

    /**
     * @param OperationInterface ...$operations
     */
    final public function add(OperationInterface ...$operations): self
    {
        $this->operations = array_merge($this->operations, $operations);

        return $this;
    }

    /**
     * @param mixed[] $parameters
     */
    final public function operation(string $class, iterable $parameters = []): self
    {
        $operation = new $class(...$parameters);
        $this->add($operation);

        return $this;
    }

    /**
     * @return OperationInterface[]
     */
    final public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @return void
     */
    final public function clean(): void
    {
        $this->operations = [];
    }
}
