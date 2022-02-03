<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdentityInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;

interface TypeApiDtoInterface extends DtoInterface, IdInterface, IdentityInterface
{
    public const TYPE = 'type';
    public const BASE = 'base';
}
