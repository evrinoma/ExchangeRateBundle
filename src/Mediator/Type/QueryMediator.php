<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Type;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Repository\AliasInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\DtoBundle\Dto\DtoInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
//region SECTION: Fields
    protected static string $alias = AliasInterface::TYPE;
//endregion Fields

//region SECTION: Public
    public function createQuery(DtoInterface $dto, QueryBuilder $builder): void
    {
        $alias = $this->alias();
        /** @var $dto TypeApiDtoInterface */
        if ($dto->hasIdentity()) {
            $builder->andWhere($alias.'.identity like :identity')
                ->setParameter('identity', '%'.$dto->getIdentity().'%');
        }
    }
//endregion Public
}