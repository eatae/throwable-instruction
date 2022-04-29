<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction\Tests;

use Eatae\ThrowableInstruction\InstructionInterface;
use Eatae\ThrowableInstruction\OperationInterface;
use Eatae\ThrowableInstruction\Operator;
use Eatae\ThrowableInstruction\ThrowableInstruction;
use PHPUnit\Framework\TestCase;


class OperatorTest extends TestCase
{

    public function testGetInstruction()
    {
        $instructionStub = $this->createMock(InstructionInterface::class);
        $exception = new \Exception('', 0, $instructionStub);

        $this->assertInstanceOf(
            InstructionInterface::class,
            Operator::getInstruction($exception)
        );
    }


    public function testFollowInstruction()
    {
        $firstOperationMock = $this->createMock(OperationInterface::class);
        $firstOperationMock->expects($this->once())->method('execute');
        $secondOperationMock = $this->createMock(OperationInterface::class);
        $secondOperationMock->expects($this->once())->method('execute');

        $instruction = (new ThrowableInstruction())
            ->add($firstOperationMock)
            ->add($secondOperationMock);

        try {
            throw new \Exception('', 0, $instruction);
        } catch (\Exception $e) {
            Operator::followInstruction($e);
        }
    }
}
