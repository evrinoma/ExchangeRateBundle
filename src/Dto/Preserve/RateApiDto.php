<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDto as BaseRateApiDto;

final class RateApiDto extends BaseRateApiDto implements RateApiDtoInterface
{
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