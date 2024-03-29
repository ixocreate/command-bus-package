<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus\Factory;

use Ixocreate\CommandBus\CommandBus;
use Ixocreate\CommandBus\CommandBusConfig;
use Ixocreate\CommandBus\Factory\CommandBusFactory;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

final class CommandBusFactoryTest extends TestCase
{
    /**
     * @covers \Ixocreate\CommandBus\Factory\CommandBusFactory::__invoke
     */
    public function testFactory()
    {
        $container = $this->createMock(ServiceManagerInterface::class);
        $container->method('get')->willReturnCallback(function ($param) {
            if ($param === CommandBusConfig::class) {
                return new CommandBusConfig([]);
            }
            return $this->createMock(ContainerInterface::class);
        });

        $commandBusFactory = new CommandBusFactory();

        $this->assertInstanceOf(CommandBus::class, $commandBusFactory($container, CommandBus::class));
    }
}
