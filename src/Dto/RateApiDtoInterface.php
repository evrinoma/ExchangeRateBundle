<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdInterface;

interface RateApiDtoInterface extends DtoInterface, IdInterface
{
//region SECTION: Dto
    public function getBaseApiDto(): TypeApiDtoInterface;

    public function getTypeApiDto(): TypeApiDtoInterface;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    public function getValue(): float;

    public function getCreated(): \DateTimeImmutable;
//endregion Getters/Setters
}
