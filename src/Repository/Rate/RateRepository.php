<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Rate;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateProxyException;
use Evrinoma\ExchangeRateBundle\Mediator\Rate\QueryMediatorInterface;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

class RateRepository extends ServiceEntityRepository implements RateRepositoryInterface
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
    /**
     * @param RateInterface $rate
     *
     * @return bool
     * @throws RateCannotBeSavedException
     * @throws ORMException
     */
    public function save(RateInterface $rate): bool
    {
        try {
            $this->getEntityManager()->persist($rate);
        } catch (ORMInvalidArgumentException $e) {
            throw new RateCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param RateInterface $rate
     *
     * @return bool
     */
    public function remove(RateInterface $rate): bool
    {
        try {
            $this->getEntityManager()->remove($rate);
        } catch (ORMInvalidArgumentException $e) {
            throw new RateCannotBeRemovedException($e->getMessage());
        }

        return true;
    }
//endregion Public

//region SECTION: Find Filters Repository
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return array
     * @throws RateNotFoundException
     */
    public function findByCriteria(RateApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilder($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $ratees = $this->mediator->getResult($dto, $builder);

        if (count($ratees) === 0) {
            throw new RateNotFoundException("Cannot find rate by findByCriteria");
        }

        return $ratees;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     * @throws RateNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): RateInterface
    {
        /** @var RateInterface $rate */
        $rate = parent::find($id);

        if ($rate === null) {
            throw new RateNotFoundException("Cannot find rate with id $id");
        }

        return $rate;
    }

    /**
     * @param string $id
     *
     * @return RateInterface
     * @throws RateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): RateInterface
    {
        $em = $this->getEntityManager();

        $rate = $em->getReference($this->getEntityName(), $id);

        if (!$em->contains($rate)) {
            throw new RateProxyException("Proxy doesn't exist with $id");
        }

        return $rate;
    }
//endregion Find Filters Repository

}