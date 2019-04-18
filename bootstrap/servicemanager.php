<?php
declare(strict_types=1);
namespace Ixocreate\Package\CommandBus;

use Ixocreate\CommandBus\CommandBus;
use Ixocreate\Package\CommandBus\Command\CommandSubManager;
use Ixocreate\Package\CommandBus\Factory\CommandBusFactory;
use Ixocreate\Package\CommandBus\Handler\HandlerSubManager;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(CommandBus::class, CommandBusFactory::class);
$serviceManager->addSubManager(CommandSubManager::class);
$serviceManager->addSubManager(HandlerSubManager::class);
