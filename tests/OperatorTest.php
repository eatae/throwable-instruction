<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Tests;

use eatae\ThrowableInstruction\ThrowableInstructionInterface;
use eatae\ThrowableInstruction\OperationInterface;
use eatae\ThrowableInstruction\Operator;
use eatae\ThrowableInstruction\ThrowableInstruction;
use PHPUnit\Framework\TestCase;
use Throwable;
use Exception;
use LogicException;

class OperatorTest extends TestCase
{
    private function getEchoOperation(): OperationInterface
    {
        return (new class implements OperationInterface {
            public function execute(): void
            {
                echo 'Execute EchoOperation';
            }
        });
    }

    public function testGetInstruction(): void
    {
        $instructionStub = $this->createMock(ThrowableInstructionInterface::class);
        $exception = new Exception('', 0, $instructionStub);

        $this->assertInstanceOf(
            ThrowableInstructionInterface::class,
            Operator::getInstruction($exception)
        );
    }

    public function testFollowInstructionInCatch(): void
    {
        $firstOperationMock = $this->createMock(OperationInterface::class);
        $secondOperationMock = $this->createMock(OperationInterface::class);

        $firstOperationMock->expects($this->once())->method('execute');
        $secondOperationMock->expects($this->once())->method('execute');
        /* act */
        $instruction = (new ThrowableInstruction())
            ->add($firstOperationMock)
            ->add($secondOperationMock);

        try {
            throw new Exception('', 0, $instruction);
        } catch (Exception $e) {
            Operator::followInstruction($e);
        }
    }

    public function testFollowInstructionInFinally(): void
    {
        $operation = $this->getEchoOperation();
        $operationMock = $this->createMock(OperationInterface::class);
        $operationMock->expects($this->once())->method('execute');
        $this->expectOutputRegex('/LogicException message/');
        $this->expectOutputRegex('/Execute EchoOperation/');
        /* act */
        $instruction = (new ThrowableInstruction())
            ->add($operation)
            ->add($operationMock);

        try {
            throw new LogicException('LogicException message', 0, $instruction);
        } catch (LogicException $e) {
            echo $e->getMessage();
        } finally {
            if (isset($e) && is_subclass_of($e, Throwable::class)) {
                Operator::followInstruction($e);
            }
        }
    }

    public function testFollowInstructionOperationExecuteOnce(): void
    {
        $operationMock = $this->createMock(OperationInterface::class);
        $operationMock->expects($this->once())->method('execute');
        /* act */
        $instruction = (new ThrowableInstruction())
            ->add($operationMock);

        try {
            throw new LogicException('LogicException message', 0, $instruction);
        } catch (LogicException $e) {
            echo $e->getMessage();
            Operator::followInstruction($e);
        } finally {
            if (isset($e) && is_subclass_of($e, Throwable::class)) {
                Operator::followInstruction($e);
            }
        }
    }
}
