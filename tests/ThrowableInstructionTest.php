<?php
declare(strict_types=1);

namespace eatae\ThrowableInstruction\Tests;

use eatae\ThrowableInstruction\OperationInterface;
use eatae\ThrowableInstruction\Tests\Mocks\NoParametersOperationMock;
use eatae\ThrowableInstruction\Tests\Mocks\SomeParametersOperationMock;
use eatae\ThrowableInstruction\ThrowableInstruction;
use PHPUnit\Framework\TestCase;


class ThrowableInstructionTest extends TestCase
{
    private ThrowableInstruction $instruction;

    protected function setUp(): void
    {
        $this->instruction = new ThrowableInstruction();
    }

    public function testAdd(): void
    {
        $firstOperationStub = $this->createMock(OperationInterface::class);
        $secondOperationStub = $this->createMock(OperationInterface::class);
        /* act */
        $this->instruction->add($firstOperationStub, $secondOperationStub);

        $this->assertCount(2, $this->instruction->getOperations());
    }

    public function testOperationCallConstructWithoutParameters(): void
    {
        /* act */
        $this->instruction->operation(NoParametersOperationMock::class);

        $this->assertCount(1, $this->instruction->getOperations());
        $this->assertContainsOnlyInstancesOf(
            NoParametersOperationMock::class,
            $this->instruction->getOperations()
        );
    }

    public function testOperationCallConstructWithParameters(): void
    {
        /* act */
        $this->instruction->operation(SomeParametersOperationMock::class, ['first', 2, ['third']]);

        $this->assertCount(1, $this->instruction->getOperations());
        $this->assertContainsOnlyInstancesOf(
            SomeParametersOperationMock::class,
            $this->instruction->getOperations()
        );
    }
}
