<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeCreatedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

interface CommandMediatorInterface
{
    /**
     * @param RateApiDtoInterface $dto
     * @param RateInterface       $entity
     *
     * @return RateInterface
     * @throws RateCannotBeSavedException
     */
    public function onUpdate(RateApiDtoInterface $dto, RateInterface $entity): RateInterface;

    /**
     * @param RateApiDtoInterface $dto
     * @param RateInterface       $entity
     *
     * @throws RateCannotBeRemovedException
     */
    public function onDelete(RateApiDtoInterface $dto, RateInterface $entity): void;

    /**
     * @param RateApiDtoInterface $dto
     * @param RateInterface       $entity
     *
     * @return RateInterface
     * @throws RateCannotBeSavedException
     * @throws RateCannotBeCreatedException
     */
    public function onCreate(RateApiDtoInterface $dto, RateInterface $entity): RateInterface;
}