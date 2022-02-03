<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDto as BaseRateApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

final class RateApiDto extends BaseRateApiDto implements RateApiDtoInterface
{
//region SECTION: Dto
    /**
     * @param TypeApiDto|null $baseApiDto
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): void
    {
        parent::setBaseApiDto($baseApiDto);
    }

    /**
     * @param TypeApiDto|null $typeApiDto
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): void
    {
        parent::setTypeApiDto($typeApiDto);
    }

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): void
    {
        parent::setRangeApiDto($rangeApiDto);
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        parent::setValue($value);
    }

    /**
     * @param \DateTimeImmutable|null $created
     */
    public function setCreated(\DateTimeImmutable $created): void
    {
        parent::setCreated($created);
    }
//endregion Getters/Setters
}