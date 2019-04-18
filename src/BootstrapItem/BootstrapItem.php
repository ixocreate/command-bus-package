<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\CommandBus\BootstrapItem;

use Ixocreate\Application\BootstrapItemInterface;
use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Package\CommandBus\Configurator;

final class BootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new Configurator();
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
