<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;

interface RangeApiDtoInterface extends DtoInterface
{
    /**
     * @return \DateTimeImmutable|null
     */
    public function getTo(): ?\DateTimeImmutable;
    /**
     * @return \DateTimeImmutable|null
     */
    public function getFrom(): ?\DateTimeImmutable;
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
}
