<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface as BaseRateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;

interface RateApiDtoInterface
{
//region SECTION: Dto
    /**
     * @param TypeApiDto|null $baseApiDto
     */
    public function setBaseApiDto(?TypeApiDto $baseApiDto): BaseRateApiDtoInterface;

    /**
     * @param TypeApiDto|null $typeApiDto
     */
    public function setTypeApiDto(?TypeApiDto $typeApiDto): BaseRateApiDtoInterface;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     */
    public function setValue(float $value): BaseRateApiDtoInterface;

    /**
     * @param \DateTimeImmutable|null $created
     */
    public function setCreated(\DateTimeImmutable $created): BaseRateApiDtoInterface;
//endregion Getters/Setters
}
