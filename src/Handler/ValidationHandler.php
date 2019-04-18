<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\CommandBus;

use Ixocreate\CommandBus\CommandInterface;
use Ixocreate\CommandBus\DispatchInterface;
use Ixocreate\CommandBus\HandlerInterface;
use Ixocreate\CommandBus\Result\Result;
use Ixocreate\CommandBus\ResultInterface;
use Ixocreate\Validation\Validator;

final class ValidationHandler implements HandlerInterface
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * ValidationHandler constructor.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param CommandInterface $command
     * @param DispatchInterface $dispatcher
     * @throws \Exception
     * @return ResultInterface
     */
    public function handle(CommandInterface $command, DispatchInterface $dispatcher): ResultInterface
    {
        if (!$this->validator->supports($command)) {
            return $dispatcher->dispatch($command);
        }

        $validationResult = $this->validator->validate($command);
        if ($validationResult->isSuccessful()) {
            return $dispatcher->dispatch($command);
        }

        return new Result(ResultInterface::STATUS_ERROR, $command, $validationResult->all()->toArray());
    }
}
