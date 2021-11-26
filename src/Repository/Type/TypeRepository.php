<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Type;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeProxyException;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\ExchangeRateBundle\Repository\AliasInterface;
use Evrinoma\ExchangeRateBundle\Mediator\Type\QueryMediatorInterface;

class TypeRepository extends ServiceEntityRepository implements TypeRepositoryInterface
{

//region SECTION: Fields
    private QueryMediatorInterface $mediator;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
//endregion Constructor

//region SECTION: Public
    public function save(TypeInterface $type): bool
    {
        try {
            $this->getEntityManager()->persist($type);
        } catch (ORMInvalidArgumentException $e) {
            throw new TypeCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    public function remove(TypeInterface $type): bool
    {
        try {
            $this->getEntityManager()->remove($type);
        } catch (ORMInvalidArgumentException $e) {
            throw new TypeCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    public function proxy(string $id): TypeInterface
    {
        $em = $this->getEntityManager();

        $type = $em->getReference($this->getEntityName(), $id);

        if (!$em->contains($type)) {
            throw new TypeProxyException("Proxy doesn't exist with $id");
        }

        return $type;
    }
//endregion Public

//region SECTION: Find Filters Repository
    public function findByCriteria(TypeApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilder(AliasInterface::TYPE);

        $this->mediator->createQuery($dto, $builder);

        $type = $builder->getQuery()->getResult();

        if (count($type) === 0) {
            throw new TypeNotFoundException("Cannot find type by findByCriteria");
        }

        return $type;
    }

    public function find($id, $lockMode = null, $lockVersion = null): TypeInterface
    {
        /** @var TypeInterface $type */
        $type = parent::find($id);

        if ($type === null) {
            throw new TypeNotFoundException("Cannot find type with id $id");
        }

        return $type;
    }
//endregion Find Filters Repository
}