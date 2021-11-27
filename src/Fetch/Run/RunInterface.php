<?php

namespace Evrinoma\ExchangeRateBundle\Fetch\Run;

use Evrinoma\ExchangeRateBundle\Exception\Rate\UnprocessableException;
use Evrinoma\ExchangeRateBundle\Fetch\Exception\Handler\NotValidException;
use Evrinoma\ExchangeRateBundle\Fetch\Handler\HandlerInterface;

interface RunInterface
{
    /**
     * @return HandlerInterface
     * @throws NotValidException
     * @throws UnprocessableException
     */
    public function run(): HandlerInterface;
}