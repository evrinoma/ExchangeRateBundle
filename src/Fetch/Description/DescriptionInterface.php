<?php

namespace Evrinoma\ExchangeRateBundle\Fetch\Description;

use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\CommunicationException;
use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\DescriptionNotValidException;

interface DescriptionInterface
{
//region SECTION: Public
    /**
     * @throws CommunicationException
     * @return array
     */
    public function load():array;

    /**
     * @throws DescriptionNotValidException
     * @return bool
     */
    public function configure(): bool;
//endregion Public
}