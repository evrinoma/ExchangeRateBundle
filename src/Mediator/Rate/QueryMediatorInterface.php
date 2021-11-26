<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Rate;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param RateApiDtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return mixed
     */
    public function createQuery(RateApiDtoInterface $dto, QueryBuilder $builder):void;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param RateApiDtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return array
     */
    public function getResult(RateApiDtoInterface $dto, QueryBuilder $builder): array;
}