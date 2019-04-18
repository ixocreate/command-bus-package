<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus\Package;

use Ixocreate\CommandBus\Package\Command\CommandSubManager;
use Ixocreate\CommandBus\Package\Handler\HandlerSubManager;
use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\CommandBus\Package\CommandInterface;
use Ixocreate\CommandBus\Package\HandlerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;
use Zend\Stdlib\PriorityList;

final class Configurator implements ConfiguratorInterface
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
        $serviceRegistry->add(Config::class, new Config([
            'handlers' => \array_keys($this->handlers->toArray()),
        ]));

        $this->handlerSubManager->registerService($serviceRegistry);
        $this->commandSubManager->registerService($serviceRegistry);
    }
}
