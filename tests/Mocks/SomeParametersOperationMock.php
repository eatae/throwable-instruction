<?php

declare(strict_types=1);

namespace eatae\ThrowableInstruction\Tests\Mocks;

use eatae\ThrowableInstruction\OperationInterface;

class SomeParametersOperationMock implements OperationInterface
{
    protected string $first;
    protected int $second;
    /** @var mixed[] */
    protected array $third;

    /**
     * @param mixed[] $third
     */
    public function __construct(string $first, int $second, array $third)
    {
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
    }

    public function execute(): void
    {
        echo "first: $this->first; second: $this->second; ".
            "third: ".array_shift($this->third);
    }
}
