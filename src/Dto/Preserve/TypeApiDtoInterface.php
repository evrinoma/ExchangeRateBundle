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

    /**
     * @param int|null $id
     *
     * @return BaseTypeApiDtoInterface
     */
    public function setId(?int $id): BaseTypeApiDtoInterface;
//endregion Getters/Setters
}
