<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus\Package\Bootstrap;

use Ixocreate\Application\Service\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\CommandBus\Package\Configurator;

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