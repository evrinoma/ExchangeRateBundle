<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdInterface;

interface RateApiDtoInterface extends DtoInterface, IdInterface
{
//region SECTION: Public
    /**
     * @return bool
     */
    public function hasCreated(): bool;

    /**
     * @return bool
     */
    public function hasValue(): bool;
//endregion Public

//region SECTION: Dto
    /**
     * @return TypeApiDtoInterface
     */
    public function getBaseApiDto(): TypeApiDtoInterface;

    /**
     * @return TypeApiDtoInterface
     */
    public function getTypeApiDto(): TypeApiDtoInterface;

    /**
     * @return bool
     */
    public function hasBaseApiDto(): bool;

    /**
     * @return bool
     */
    public function hasTypApiDto(): bool;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    public function getValue(): ?float;

    public function getCreated(): \DateTimeImmutable;
//endregion Getters/Setters
}
