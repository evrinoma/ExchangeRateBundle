<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\ExchangeRateBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface as BaseTypeApiDtoInterface;

interface RateApiDtoInterface extends IdInterface
{
//region SECTION: Dto
    /**
     * @param BaseTypeApiDtoInterface|null $baseApiDto
     *
     * @return DtoInterface
     */
    public function setBaseApiDto(?BaseTypeApiDtoInterface $baseApiDto): DtoInterface;

    /**
     * @param BaseTypeApiDtoInterface|null $typeApiDto
     *
     * @return DtoInterface
     */
    public function setTypeApiDto(?BaseTypeApiDtoInterface $typeApiDto): DtoInterface;

    /**
     * @param BaseRangeApiDtoInterface|null $rangeApiDto
     *
     * @return DtoInterface
     */
    public function setRangeApiDto(?BaseRangeApiDtoInterface $rangeApiDto): DtoInterface;
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @param float $value
     *
     * @return DtoInterface
     */
    public function setValue(float $value): DtoInterface;

    /**
     * @param \DateTimeImmutable|null $created
     *
     * @return DtoInterface
     */
    public function setCreated(\DateTimeImmutable $created): DtoInterface;
//endregion Getters/Setters
}
