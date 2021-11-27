<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeProxyException;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\ExchangeRateBundle\Repository\Type\TypeQueryRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;

final class QueryManager implements QueryManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private TypeQueryRepositoryInterface $repository;
//endregion Fields

//region SECTION: Constructor
    public function __construct(TypeQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return array
     * @throws TypeNotFoundException
     */
    public function criteria(TypeApiDtoInterface $dto): array
    {
        try {
            $type = $this->repository->findByCriteria($dto);
        } catch (TypeNotFoundException $e) {
            throw $e;
        }

        return $type;
    }

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeProxyException
     */
    public function proxy(TypeApiDtoInterface $dto): TypeInterface
    {
        try {
            if ($dto->hasId()) {
                $type = $this->repository->proxy((string)$dto->getId());
            } else {
                throw new TypeProxyException('entity does\'t have id');
            }
        } catch (TypeProxyException $e) {
            throw $e;
        }

        return $type;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeNotFoundException
     */
    public function get(TypeApiDtoInterface $dto): TypeInterface
    {
        try {
            $type = $this->repository->find($dto->getId());
        } catch (TypeNotFoundException $e) {
            throw $e;
        }

        return $type;
    }
//endregion Getters/Setters
}