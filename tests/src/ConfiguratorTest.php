<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus;

use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Application\ServiceManager\SubManagerConfig;
use Ixocreate\CommandBus\Command\CommandSubManager;
use Ixocreate\CommandBus\CommandBusConfig;
use Ixocreate\CommandBus\CommandBusConfigurator;
use Ixocreate\CommandBus\Handler\HandlerSubManager;
use PHPUnit\Framework\TestCase;

class ConfiguratorTest extends TestCase
{
    /**
     * @covers \Ixocreate\CommandBus\CommandBusConfigurator
     */
    public function testConfigurator()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $configurator = new CommandBusConfigurator();
        $configurator->addHandler('handler1', null, 5);
        $configurator->addHandler('handler2', null, 10);
        $configurator->addHandler('handler3', null, 1);

        $configurator->addCommand('command1');
        $configurator->addCommandDirectory(__DIR__);

        $configurator->registerService($serviceRegistry);

        $this->assertArrayHasKey(CommandBusConfig::class, $collector);
        $this->assertArrayHasKey(HandlerSubManager::class . '::Config', $collector);
        $this->assertArrayHasKey(CommandSubManager::class . '::Config', $collector);
        $this->assertInstanceOf(CommandBusConfig::class, $collector[CommandBusConfig::class]);
        $this->assertInstanceOf(SubManagerConfig::class, $collector[HandlerSubManager::class . '::Config']);
        $this->assertInstanceOf(SubManagerConfig::class, $collector[CommandSubManager::class . '::Config']);

        $this->assertSame(['handler2', 'handler1', 'handler3'], $collector[CommandBusConfig::class]->handlers());
        $this->assertArrayHasKey('handler1', $collector[HandlerSubManager::class . '::Config']->getFactories());
        $this->assertArrayHasKey('handler2', $collector[HandlerSubManager::class . '::Config']->getFactories());
        $this->assertArrayHasKey('handler3', $collector[HandlerSubManager::class . '::Config']->getFactories());
        $this->assertArrayHasKey('command1', $collector[CommandSubManager::class . '::Config']->getFactories());
    }
}
