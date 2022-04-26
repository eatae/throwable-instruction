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

    /**
     * Test static method
     */
    public function testRun()
    {
        $instructionMock = $this->createMock(Instruction::class);
        $instructionMock->expects($this->once())->method('execute');

        $instructor = (new ThrowableInstructor())->add($instructionMock);
        $e = new \Exception('', 0, $instructor);

        try {
            throw $e;
        } catch (\Exception $e) {
            ThrowableInstructor::run($e->getPrevious());
        }
    }
}
