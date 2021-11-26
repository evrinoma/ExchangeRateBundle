<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateProxyException;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;
use Evrinoma\ExchangeRateBundle\Repository\Rate\RateQueryRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;

final class QueryManager implements QueryManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private RateQueryRepositoryInterface $repository;
//endregion Fields

//region SECTION: Constructor
    public function __construct(RateQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return array
     * @throws RateNotFoundException
     */
    public function criteria(RateApiDtoInterface $dto): array
    {
        try {
            $rate = $this->repository->findByCriteria($dto);
        } catch (RateNotFoundException $e) {
            throw $e;
        }

        return $rate;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }

    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateNotFoundException
     */
    public function get(RateApiDtoInterface $dto): RateInterface
    {
        try {
            $rate = $this->repository->find($dto->getId());
        } catch (RateNotFoundException $e) {
            throw $e;
        }

        return $rate;
    }

    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateProxyException
     */
    public function proxy(RateApiDtoInterface $dto): RateInterface
    {
        try {
            $rate = $this->repository->proxy($dto->getId());
        } catch (RateProxyException $e) {
            throw $e;
        }

        return $rate;
    }
//endregion Getters/Setters
}