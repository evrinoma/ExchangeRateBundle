<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Helper;

trait BaseRateTestTrait
{
    protected function createRate(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }
}