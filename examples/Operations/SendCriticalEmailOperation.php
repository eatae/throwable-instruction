<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Examples\Operations;

use eatae\ThrowableInstruction\OperationInterface;

class SendCriticalEmailOperation implements OperationInterface
{

    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function execute(): void
    {
        echo "Notice: {$this->message}";
    }
}
