<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto as BaseTypeApiDto;

final class TypeApiDto extends BaseTypeApiDto implements TypeApiDtoInterface
{
//region SECTION: Getters/Setters
    /**
     * @param string $identity
     */
    public function setIdentity(string $identity): void
    {
        parent::setIdentity($identity);
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        parent::setId($id);
    }
//endregion Getters/Setters
}