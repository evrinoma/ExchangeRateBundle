<?php

namespace Evrinoma\ExchangeRateBundle\Fetch\Handler;

use Evrinoma\ExchangeRateBundle\Fetch\Exception\Handler\NotValidException;

interface HandlerInterface
{
//region SECTION: Public
    /**
     * @throws NotValidException
     * @return bool
     */
    public function isValid(): bool;
//endregion Public

//region SECTION: Getters/Setters
    public function getData(): \Generator;

    public function getHeader(): \Generator;
//endregion Getters/Setters
}