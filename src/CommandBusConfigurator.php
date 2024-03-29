<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus;

use Ixocreate\Application\Configurator\ConfiguratorInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Application\ServiceManager\SubManagerConfigurator;
use Ixocreate\CommandBus\Command\CommandInterface;
use Ixocreate\CommandBus\Command\CommandSubManager;
use Ixocreate\CommandBus\Handler\HandlerInterface;
use Ixocreate\CommandBus\Handler\HandlerSubManager;
use Laminas\Stdlib\PriorityList;

final class CommandBusConfigurator implements ConfiguratorInterface
{
    /**
     * @var PriorityList
     */
    private $handlers;

    /**
     * @var SubManagerConfigurator
     */
    private $handlerSubManager;

    /**
     * @var SubManagerConfigurator
     */
    private $commandSubManager;

    public function __construct()
    {
        $this->handlers = new PriorityList();
        $this->handlerSubManager = new SubManagerConfigurator(HandlerSubManager::class, HandlerInterface::class);
        $this->commandSubManager = new SubManagerConfigurator(CommandSubManager::class, CommandInterface::class);
    }

    public function addHandler(string $name, ?string $factory = null, ?int $priority = 0): void
    {
        $this->handlers->insert($name, $factory, $priority);
        $this->handlerSubManager->addFactory($name, $factory);
    }

    public function addCommand(string $name, string $factory = null): void
    {
        $this->commandSubManager->addFactory($name, $factory);
    }

    public function addCommandDirectory(string $directory, bool $recursive = true): void
    {
        $this->commandSubManager->addDirectory($directory, $recursive, [CommandInterface::class]);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $serviceRegistry->add(CommandBusConfig::class, new CommandBusConfig([
            'handlers' => \array_keys($this->handlers->toArray()),
        ]));

        $this->handlerSubManager->registerService($serviceRegistry);
        $this->commandSubManager->registerService($serviceRegistry);
    }
}
