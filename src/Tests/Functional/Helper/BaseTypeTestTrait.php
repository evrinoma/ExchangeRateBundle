<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Helper;

trait BaseTypeTestTrait
{
    protected function createType(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }
}