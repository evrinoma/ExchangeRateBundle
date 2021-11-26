<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Rate;

use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

interface RateCommandRepositoryInterface
{
    /**
     * @param RateInterface $rate
     *
     * @return bool
     * @throws RateCannotBeSavedException
     */
    public function save(RateInterface $rate): bool;

    /**
     * @param RateInterface $rate
     *
     * @return bool
     * @throws RateCannotBeRemovedException
     */
    public function remove(RateInterface $rate): bool;
}