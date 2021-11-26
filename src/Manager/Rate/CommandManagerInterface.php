<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;


interface CommandManagerInterface
{
//region SECTION: Public
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateInvalidException
     */
    public function post(RateApiDtoInterface $dto): RateInterface;

    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateInvalidException
     * @throws RateNotFoundException
     */
    public function put(RateApiDtoInterface $dto): RateInterface;

    /**
     * @param RateApiDtoInterface $dto
     *
     * @throws RateCannotBeRemovedException
     * @throws RateNotFoundException
     */
    public function delete(RateApiDtoInterface $dto): void;
//endregion Public
}