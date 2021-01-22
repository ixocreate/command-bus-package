<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\CommandBus;

use Ixocreate\CommandBus\CommandBusBootstrapItem;
use Ixocreate\CommandBus\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\CommandBus\Package
     */
    public function testPackage()
    {
        $package = new Package();

        $this->assertSame([CommandBusBootstrapItem::class], $package->getBootstrapItems());
        $this->assertEmpty($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}
