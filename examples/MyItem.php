<?php

namespace eatae\ThrowableInstruction\Examples;

use eatae\ThrowableInstruction\Examples\Operations\ImportantMessageOperation;
use eatae\ThrowableInstruction\Examples\Operations\NoticeMessageOperation;
use eatae\ThrowableInstruction\Examples\Operations\SendCriticalEmailOperation;
use eatae\ThrowableInstruction\ThrowableInstruction;
use eatae\ThrowableInstruction\ThrowableInstructionInterface;
use \InvalidArgumentException;

class MyItem
{
    protected ThrowableInstructionInterface $instruction;
    protected ValidatorInterface $validator;

    public function __construct(ThrowableInstructionInterface $instruction, ValidatorInterface $validator)
    {
        $this->instruction = $instruction;
        $this->validator = $validator;
    }

    public function doSomething(object $entity): void
    {
        if (!$this->validator->validate($entity)) {
            /*
             *  InvalidArgumentException without instructions
             */
            throw new InvalidArgumentException('Entity is not valid object');
        }
    }

    public function doSomethingElse(object $item): void
    {
        if (!$this->validator->validate($item)) {
            /*
             * InvalidArgumentException with Notice instructions
             */
            throw new InvalidArgumentException(
                'Item is not valid object',
                0,
                $this->instruction->operation(NoticeMessageOperation::class, ['Invalid values passed'])
            );
        }
    }

    public function doSomethingImportant(object $importantItem): void
    {
        if (!$this->validator->validate($importantItem)) {
            /*
             * InvalidArgumentException with Important instructions
             */
            throw new InvalidArgumentException(
                'Important Item is not valid object',
                0,
                $this->instruction
                    ->operation(ImportantMessageOperation::class, ['Important values are not valid', 500])
                    ->operation(SendCriticalEmailOperation::class, ['Any message text'])
            );
        }
    }
}
