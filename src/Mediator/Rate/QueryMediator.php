<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Rate;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\QueryBuilder;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Repository\AliasInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\DtoBundle\Dto\DtoInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
//region SECTION: Fields
    protected static string $alias = AliasInterface::RATE;
//endregion Fields

//region SECTION: Public
    public function createQuery(DtoInterface $dto, QueryBuilder $builder): void
    {
        $alias = $this->alias();
        /** @var $dto RateApiDtoInterface */
        if ($dto->hasTypApiDto() && $dto->getTypeApiDto()->getIdentity()) {
            $aliasType = AliasInterface::TYPE;
            $builder
                ->leftJoin($alias.'.type', $aliasType)
                ->addSelect($aliasType)
                ->andWhere($aliasType.'.identity = :identityType')
                ->setParameter('identityType', $dto->getTypeApiDto()->getIdentity());
        }
        /** @var $dto RateApiDtoInterface */
        if ($dto->hasBaseApiDto() && $dto->getBaseApiDto()->getIdentity()) {
            $aliasType = AliasInterface::BASE;
            $builder
                ->leftJoin($alias.'.base', $aliasType)
                ->addSelect($aliasType)
                ->andWhere($aliasType.'.identity = :identityBase')
                ->setParameter('identityBase', $dto->getBaseApiDto()->getIdentity());
        }
        if ($dto->hasValue()) {
            $builder
                ->andWhere($alias.'.value = :value')
                ->setParameter('value', $dto->getValue());
        }
        if ($dto->hasCreated()) {
            $builder->andWhere($alias.'.created :created >= :last')
                ->setParameter('created', $dto->getCreated(), Types::DATETIME_IMMUTABLE)
                ->setParameter('last', new \DateTime(), Types::DATETIME_IMMUTABLE);
        }
    }
//endregion Public
}