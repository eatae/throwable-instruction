<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Examples;

use eatae\ThrowableInstruction\Operator;
use eatae\ThrowableInstruction\ThrowableInstruction;
use eatae\ThrowableInstruction\ThrowableInstructionInterface;
use \InvalidArgumentException;
use \Exception;

class SomeService
{
    protected MyItem $item;
    protected ThrowableInstructionInterface $instruction;
    protected ValidatorInterface $validator;
    protected LoggerInterface $logger;

    public function __construct()
    {
        $this->instruction = new ThrowableInstruction();
        $this->validator = new class implements ValidatorInterface {
            public function validate(object $inner): bool
            {
                return false;
            }
        };
        $this->logger = new class implements LoggerInterface {
            public function log(string $message, int $code = 0): void
            {
            }
        };
        $this->item = new MyItem($this->instruction, $this->validator);
    }

    public function whereExceptionsAreCaught(): void
    {
        $object = new \stdClass();
        try {
            /*
             * Some code...
             */
            $this->item->doSomethingElse($object, $this->validator, $this->instruction);
        } catch (Exception $e) {
            $this->logger->log($e->getMessage(), $e->getCode());
        } finally {
            /*
             * Call instructions for all exceptions
             */
            if (isset($e) && is_subclass_of($e, Exception::class)) {
                Operator::followInstruction($e);
            }
        }
    }
}
