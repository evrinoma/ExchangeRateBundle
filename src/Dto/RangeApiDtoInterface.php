<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;

interface RangeApiDtoInterface extends DtoInterface
{
    public const FROM     = 'from';
    public const TO       = 'to';
    public const RANGE = 'range';
//region SECTION: Public
    /**
     * @return bool
     */
    public function hasTo(): bool;

    /**
     * @return bool
     */
    public function hasFrom(): bool;

    /**
     * @return bool
     */
    public function hasRange(): bool;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return \DateTimeImmutable|null
     */
    public function getTo(): ?\DateTimeImmutable;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getFrom(): ?\DateTimeImmutable;
//endregion Getters/Setters
}
