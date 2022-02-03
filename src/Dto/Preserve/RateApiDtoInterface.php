<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;

interface RateApiDtoInterface
{
//region SECTION: Dto
    /**
     * @param BaseTypeApiDtoInterface|null $baseApiDto
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): void;

    /**
     * @param BaseTypeApiDtoInterface|null $typeApiDto
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): void;

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): void;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     */
    public function setValue(float $value): void;

    /**
     * @param \DateTimeImmutable|null $created
     */
    public function setCreated(\DateTimeImmutable $created): void;
//endregion Getters/Setters
}
