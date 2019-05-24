<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\CommandBus\CommandBusConfigurator;
use Ixocreate\CommandBus\Handler\ExecutionHandler;
use Ixocreate\CommandBus\Handler\FilterHandler;
use Ixocreate\CommandBus\Handler\ValidationHandler;

/** @var CommandBusConfigurator $commandBus */
$commandBus->addHandler(FilterHandler::class, null, 1000001);
$commandBus->addHandler(ValidationHandler::class, null, 1000000);
$commandBus->addHandler(ExecutionHandler::class, null, 0);
