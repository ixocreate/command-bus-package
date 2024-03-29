<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus;

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\CommandBus\Command\CommandSubManager;
use Ixocreate\CommandBus\Factory\CommandBusFactory;
use Ixocreate\CommandBus\Handler\HandlerSubManager;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(CommandBus::class, CommandBusFactory::class);
$serviceManager->addSubManager(CommandSubManager::class);
$serviceManager->addSubManager(HandlerSubManager::class);
