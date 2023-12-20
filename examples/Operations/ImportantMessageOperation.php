<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Examples\Operations;

use eatae\ThrowableInstruction\OperationInterface;

class ImportantMessageOperation implements OperationInterface
{
    protected string $message;
    protected int $code;

    public function __construct(string $message, int $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function execute(): void
    {
        echo "Important: {$this->message}. Code: {$this->code}";
    }
}
