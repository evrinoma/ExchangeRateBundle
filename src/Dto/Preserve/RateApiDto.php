<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDto as BaseRateApiDto;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface as BaseRateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

final class RateApiDto extends BaseRateApiDto implements RateApiDtoInterface
{
//region SECTION: Dto
    /**
     * @param TypeApiDto|null $baseApiDto
     *
     * @return RateApiDtoInterface
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): BaseRateApiDtoInterface
    {
        return parent::setBaseApiDto($baseApiDto);
    }

    /**
     * @param TypeApiDto|null $typeApiDto
     *
     * @return RateApiDtoInterface
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): BaseRateApiDtoInterface
    {
        return parent::setTypeApiDto($typeApiDto);
    }

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     *
     * @return BaseRateApiDtoInterface
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): BaseRateApiDtoInterface
    {
        return parent::setRangeApiDto($rangeApiDto);
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     *
     * @return RateApiDtoInterface
     */
    public function setValue(float $value): BaseRateApiDtoInterface
    {
        return parent::setValue($value);
    }

    /**
     * @param \DateTimeImmutable|null $created
     *
     * @return RateApiDtoInterface
     */
    public function setCreated(\DateTimeImmutable $created): BaseRateApiDtoInterface
    {
        return parent::setCreated($created);
    }
//endregion Getters/Setters
}