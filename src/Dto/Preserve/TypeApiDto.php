<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto as BaseTypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

final class TypeApiDto extends BaseTypeApiDto implements TypeApiDtoInterface
{
//region SECTION: Getters/Setters
    /**
     * @param string $identity
     *
     * @return BaseTypeApiDtoInterface
     */
    public function setIdentity(string $identity): BaseTypeApiDtoInterface
    {
        return parent::setIdentity($identity);
    }

    /**
     * @param int|null $id
     *
     * @return BaseTypeApiDtoInterface
     */
    public function setId(?int $id): BaseTypeApiDtoInterface
    {
        return parent::setId($id);
    }
//endregion Getters/Setters
}