<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Configurator\ConfiguratorInterface;

final class CommandBusBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new CommandBusConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return "commandBus";
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return "command-bus.php";
    }
}
