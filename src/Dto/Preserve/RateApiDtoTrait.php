<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

trait RateApiDtoTrait
{
//region SECTION: Dto
    /**
     * @param int|null $id
     *
     * @return DtoInterface
     */
    public function setId(?int $id): DtoInterface
    {
        return parent::setId($id);
    }

    /**
     * @param TypeApiDto|null $baseApiDto
     *
     * @return DtoInterface
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): DtoInterface
    {
        return parent::setBaseApiDto($baseApiDto);
    }

    /**
     * @param TypeApiDto|null $typeApiDto
     *
     * @return DtoInterface
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): DtoInterface
    {
        return parent::setTypeApiDto($typeApiDto);
    }

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     *
     * @return DtoInterface
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): DtoInterface
    {
        return parent::setRangeApiDto($rangeApiDto);
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     *
     * @return DtoInterface
     */
    public function setValue(float $value): DtoInterface
    {
        return parent::setValue($value);
    }

    /**
     * @param \DateTimeImmutable|null $created
     *
     * @return DtoInterface
     */
    public function setCreated(\DateTimeImmutable $created): DtoInterface
    {
        return parent::setCreated($created);
    }
//endregion Getters/Setters
}