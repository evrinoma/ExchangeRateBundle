<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeProxyException;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;

interface TypeQueryRepositoryInterface
{
//region SECTION: Find Filters Repository
    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return array
     * @throws TypeNotFoundException
     */
    public function findByCriteria(TypeApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return TypeInterface
     * @throws TypeNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): TypeInterface;

    /**
     * @param string $id
     *
     * @return TypeInterface
     * @throws TypeProxyException
     */
    public function proxy(string $id): TypeInterface;
//endregion Find Filters Repository
}