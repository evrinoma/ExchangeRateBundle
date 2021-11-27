<?php

namespace Evrinoma\ExchangeRateBundle\Fetch\Pull;

use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\CommunicationException;
use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\DescriptionNotValidException;

interface PullInterface
{
    /**
     * @throws CommunicationException
     * @throws DescriptionNotValidException
     * @return array
     */
    public function pull(): array;
}