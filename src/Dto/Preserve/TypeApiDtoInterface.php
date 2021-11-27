<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

interface TypeApiDtoInterface
{
//region SECTION: Getters/Setters
    /**
     * @param string $identity
     *
     * @return BaseTypeApiDtoInterface
     */
    public function setIdentity(string $identity): BaseTypeApiDtoInterface;
//endregion Getters/Setters
}
