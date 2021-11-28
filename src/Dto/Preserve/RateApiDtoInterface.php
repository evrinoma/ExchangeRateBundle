<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface as BaseRateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;

interface RateApiDtoInterface
{
//region SECTION: Dto
    /**
     * @param BaseTypeApiDtoInterface|null $baseApiDto
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): BaseRateApiDtoInterface;

    /**
     * @param BaseTypeApiDtoInterface|null $typeApiDto
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): BaseRateApiDtoInterface;

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     *
     * @return BaseRateApiDtoInterface
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): BaseRateApiDtoInterface;
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