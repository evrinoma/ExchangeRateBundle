<?php

namespace Evrinoma\ExchangeRateBundle\Factory;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

interface RateFactoryInterface
{
//region SECTION: Public
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     */
    public function create(RateApiDtoInterface $dto): RateInterface;
//endregion Public
}