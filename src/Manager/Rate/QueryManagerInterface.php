<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateProxyException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

interface QueryManagerInterface
{
//region SECTION: Public
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return array
     * @throws RateNotFoundException
     */
    public function criteria(RateApiDtoInterface $dto): array;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateNotFoundException
     */
    public function get(RateApiDtoInterface $dto): RateInterface;
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateProxyException
     */
    public function proxy(RateApiDtoInterface $dto): RateInterface;
//endregion Getters/Setters
}