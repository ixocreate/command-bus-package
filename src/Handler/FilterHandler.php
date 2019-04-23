<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus\Handler;

use Ixocreate\CommandBus\Command\CommandInterface;
use Ixocreate\CommandBus\Dispatch\DispatchInterface;
use Ixocreate\CommandBus\Result\ResultInterface;
use Ixocreate\Filter\Filter;

final class FilterHandler implements HandlerInterface
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * FilterHandler constructor.
     * @param Filter $filter
     */
    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param CommandInterface $command
     * @param DispatchInterface $dispatcher
     * @throws \Exception
     * @return ResultInterface
     */
    public function handle(CommandInterface $command, DispatchInterface $dispatcher): ResultInterface
    {
        if (!$this->filter->supports($command)) {
            return $dispatcher->dispatch($command);
        }

        return $dispatcher->dispatch($this->filter->filter($command));
    }
}
