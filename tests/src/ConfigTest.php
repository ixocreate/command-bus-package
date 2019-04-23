<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus;

use Ixocreate\CommandBus\CommandBusConfig;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @covers \Ixocreate\CommandBus\CommandBusConfig::handlers
     * @covers \Ixocreate\CommandBus\CommandBusConfig::__construct
     */
    public function testConfig()
    {
        $config = new CommandBusConfig([]);
        $this->assertSame([], $config->handlers());

        $config = new CommandBusConfig(['handlers' => ['handler1', 'handler2', 'handler3']]);
        $this->assertSame(['handler1', 'handler2', 'handler3'], $config->handlers());
    }

    /**
     * @covers \Ixocreate\CommandBus\CommandBusConfig::serialize
     * @covers \Ixocreate\CommandBus\CommandBusConfig::unserialize
     * @covers \Ixocreate\CommandBus\CommandBusConfig::__construct
     */
    public function testSerializable()
    {
        $configOptions = ['handlers' => ['handler1', 'handler2', 'handler3']];
        $config = new CommandBusConfig($configOptions);
        $serialized = \serialize($config);
        $newConfig = \unserialize($serialized);
        $this->assertSame($config->handlers(), $newConfig->handlers());
    }
}
