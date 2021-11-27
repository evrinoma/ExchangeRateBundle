<?php

namespace Evrinoma\ExchangeRateBundle\Fetch\Description;

use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\CommunicationException;
use Evrinoma\ExchangeRateBundle\Fetch\Exception\Description\DescriptionNotValidException;
use Evrinoma\ExchangeRateBundle\Fetch\Pull\PullInterface;

abstract class AbstractDescription implements DescriptionInterface, PullInterface
{
//region SECTION: Public
    /**
     * @return array
     * @throws CommunicationException
     * @throws DescriptionNotValidException
     */
    public function pull(): array
    {
        try {
            $data = $this->configure() ? $this->load() : [];
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }
//endregion Public
}