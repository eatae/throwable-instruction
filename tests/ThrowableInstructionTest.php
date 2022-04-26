<?php
declare(strict_types=1);

namespace Eatae\ThrowableInstruction\Tests;

use Eatae\ThrowableInstruction\OperationInterface;
use Eatae\ThrowableInstruction\ThrowableInstruction;
use PHPUnit\Framework\TestCase;


class ThrowableInstructionTest extends TestCase
{

    public function testAdd()
    {
        $firstOperationStub = $this->createMock(OperationInterface::class);
        $secondOperationStub = $this->createMock(OperationInterface::class);

        $sut = (new ThrowableInstruction())
            ->add($firstOperationStub, $secondOperationStub);

        $this->assertEquals(2, count($sut->getOperations()));
    }
}
