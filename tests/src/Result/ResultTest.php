<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus\Result;

use Ixocreate\Package\CommandBus\Result\Result;
use Ixocreate\Package\CommandBus\CommandInterface;
use Ixocreate\Package\CommandBus\ResultInterface;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @covers \Ixocreate\Package\CommandBus\Result\Result::command
     * @covers \Ixocreate\Package\CommandBus\Result\Result::isSuccessful
     * @covers \Ixocreate\Package\CommandBus\Result\Result::status
     * @covers \Ixocreate\Package\CommandBus\Result\Result::messages
     * @covers \Ixocreate\Package\CommandBus\Result\Result::__construct
     */
    public function testResult()
    {
        $command = $this->createMock(CommandInterface::class);

        $result = new Result(ResultInterface::STATUS_DONE, $command, ['input' => 'test']);
        $this->assertTrue($result->isSuccessful());
        $this->assertSame(ResultInterface::STATUS_DONE, $result->status());
        $this->assertSame($command, $result->command());
        $this->assertSame(['input' => 'test'], $result->messages());

        $result = new Result(ResultInterface::STATUS_ERROR, $command, ['input' => 'test']);
        $this->assertFalse($result->isSuccessful());
    }
}