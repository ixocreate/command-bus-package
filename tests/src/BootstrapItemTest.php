<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus;

use Ixocreate\CommandBus\CommandBusBootstrapItem;
use Ixocreate\CommandBus\CommandBusConfigurator;
use PHPUnit\Framework\TestCase;

class BootstrapItemTest extends TestCase
{
    /**
     * @var CommandBusBootstrapItem
     */
    private $bootstrapItem;

    /**
     *
     */
    public function setUp()
    {
        $this->bootstrapItem = new CommandBusBootstrapItem();
    }

    /**
     * @covers \Ixocreate\CommandBus\CommandBusBootstrapItem::getConfigurator
     */
    public function testGetConfigurator()
    {
        $this->assertInstanceOf(CommandBusConfigurator::class, $this->bootstrapItem->getConfigurator());
    }

    /**
     * @covers \Ixocreate\CommandBus\CommandBusBootstrapItem::getFileName
     */
    public function testGetFilename()
    {
        $this->assertSame('command-bus.php', $this->bootstrapItem->getFileName());
    }

    /**
     * @covers \Ixocreate\CommandBus\CommandBusBootstrapItem::getVariableName
     */
    public function testGetVariableName()
    {
        $this->assertSame('commandBus', $this->bootstrapItem->getVariableName());
    }
}
