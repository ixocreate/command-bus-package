<?php
declare(strict_types=1);
namespace Ixocreate\CommandBus\Package;

use Ixocreate\CommandBus\CommandBus;
use Ixocreate\CommandBus\Package\Command\CommandSubManager;
use Ixocreate\CommandBus\Package\Factory\CommandBusFactory;
use Ixocreate\CommandBus\Package\Handler\HandlerSubManager;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(CommandBus::class, CommandBusFactory::class);
$serviceManager->addSubManager(CommandSubManager::class);
$serviceManager->addSubManager(HandlerSubManager::class);
