<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus\Command;

use Ixocreate\Application\ServiceManager\NamedServiceInterface;
use Ramsey\Uuid\Uuid;

abstract class AbstractCommand implements CommandInterface, NamedServiceInterface
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * @var array
     */
    protected $data;

    /**
     * @throws \Exception
     * @return string
     */
    public function uuid(): string
    {
        if (empty($this->uuid)) {
            $this->uuid = Uuid::uuid4()->toString();
        }

        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return CommandInterface
     */
    public function withUuid(string $uuid): CommandInterface
    {
        $command = clone $this;
        $command->uuid = $uuid;

        return $command;
    }

    /**
     * @throws \Exception
     * @return \DateTimeInterface
     */
    public function createdAt(): \DateTimeInterface
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTimeImmutable();
        }

        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return CommandInterface
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): CommandInterface
    {
        $command = clone $this;
        if (!($createdAt instanceof \DateTimeImmutable)) {
            $createdAt = clone $createdAt;
        }

        $command->createdAt = $createdAt;

        return $command;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        if ($this->data === null) {
            $this->data = [];
        }

        return $this->data;
    }

    /**
     * @param array $data
     * @return CommandInterface
     */
    public function withData(array $data): CommandInterface
    {
        $command = clone $this;
        $command->data = $data;

        return $command;
    }

    public function dataValue(string $name, $default = null)
    {
        if (\array_key_exists($name, $this->data())) {
            return $this->data()[$name];
        }

        return $default;
    }
}
