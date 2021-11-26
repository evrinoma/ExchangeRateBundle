<?php

namespace Evrinoma\ExchangeRateBundle\Factory;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;

interface TypeFactoryInterface
{
    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     */
    public function create(TypeApiDtoInterface $dto): TypeInterface;
}