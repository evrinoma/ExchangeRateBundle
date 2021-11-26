<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Type;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param TypeApiDtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return mixed
     */
    public function createQuery(TypeApiDtoInterface $dto, QueryBuilder $builder):void;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param TypeApiDtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return array
     */
    public function getResult(TypeApiDtoInterface $dto, QueryBuilder $builder): array;
}