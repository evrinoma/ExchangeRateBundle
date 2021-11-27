<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

interface TypeApiDtoInterface
{
    /**
     * @param string $identity
     */
    public function setIdentity(string $identity): void;
}
