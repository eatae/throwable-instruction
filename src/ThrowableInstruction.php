<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction;

use \Exception;

class ThrowableInstruction extends Exception
    implements InstructionInterface
{
    /** @var OperationInterface[] */
    protected array $operations = [];

    /**
     * * Add instruction
     *
     * @param OperationInterface ...$operations
     */
    public function add(OperationInterface ...$operations): self
    {
        $this->operations = array_merge($this->operations, $operations);

        return $this;
    }

    /**
     * Get operations
     *
     * @return OperationInterface[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

}
