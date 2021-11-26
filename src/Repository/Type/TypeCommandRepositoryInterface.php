<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Type;

use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;

interface TypeCommandRepositoryInterface
{
    public function save(TypeInterface $type): bool;

    public function remove(TypeInterface $type): bool;
}