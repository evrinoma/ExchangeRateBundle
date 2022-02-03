<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;

interface RateApiDtoInterface extends DtoInterface, IdInterface
{
    public const CREATED  = 'timestamp';
    public const VALUE    = 'value';
//region SECTION: Public
    /**
     * @return bool
     */
    public function hasCreated(): bool;
    /**
     * @return bool
     */
    public function hasValue(): bool;
    /**
     * @return bool
     */
    public function hasBaseApiDto(): bool;
    /**
     * @return bool
     */
    public function hasTypApiDto(): bool;
//endregion Public

//region SECTION: Dto
    /**
     * @return bool
     */
    public function hasRangeApiDto(): bool;
    /**
     * @return TypeApiDtoInterface
     */
    public function getBaseApiDto(): TypeApiDtoInterface;
    /**
     * @return TypeApiDtoInterface
     */
    public function getTypeApiDto(): TypeApiDtoInterface;
    /**
     * @return RangeApiDtoInterface
     */
    public function getRangeApiDto(): RangeApiDtoInterface;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    public function getValue(): ?float;

    public function getCreated(): \DateTimeImmutable;
//endregion Getters/Setters
}
