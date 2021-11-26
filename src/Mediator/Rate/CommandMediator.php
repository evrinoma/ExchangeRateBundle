<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Rate;

use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
//region SECTION: Public
    public function onUpdate(DtoInterface $dto, $entity): RateInterface
    {
        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): RateInterface
    {
        return $entity;
    }
//endregion Public
}