<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;

trait TypeApiDtoTrait
{
//region SECTION: Getters/Setters
    /**
     * @param string $identity
     *
     * @return DtoInterface
     */
    public function setIdentity(string $identity): DtoInterface
    {
        return parent::setIdentity($identity);
    }

    /**
     * @param int|null $id
     *
     * @return DtoInterface
     */
    public function setId(?int $id): DtoInterface
    {
        return parent::setId($id);
    }
//endregion Getters/Setters
}