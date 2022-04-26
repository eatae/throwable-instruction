<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction\Examples;

use Eatae\ThrowableInstruction\OperationInterface;

class EchoOperation implements OperationInterface
{
    private int $num;

    public function __construct(int $num)
    {
        $this->num = $num;
    }

    public function execute(): void
    {
        echo 'Operation number '.$this->num;
    }
}
