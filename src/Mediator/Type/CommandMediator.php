<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Type;

use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
//region SECTION: Public
    public function onUpdate(DtoInterface $dto, $entity): TypeInterface
    {
        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): TypeInterface
    {
        return $entity;
    }
//endregion Public
}