<?php

namespace Evrinoma\ExchangeRateBundle\Repository\Rate;

use Doctrine\ORM\ORMException;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateProxyException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

interface RateQueryRepositoryInterface
{
//region SECTION: Public
    /**
     * @param string $id
     *
     * @return RateInterface
     * @throws RateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): RateInterface;
//endregion Public

//region SECTION: Find Filters Repository
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return array
     * @throws RateNotFoundException
     */
    public function findByCriteria(RateApiDtoInterface $dto): array;

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return RateInterface
     * @throws RateNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): RateInterface;
//endregion Find Filters Repository
}