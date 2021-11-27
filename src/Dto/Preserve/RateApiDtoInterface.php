<?php

namespace Evrinoma\ExchangeRateBundle\Dto\Preserve;

interface RateApiDtoInterface
{
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
