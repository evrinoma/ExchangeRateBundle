<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\Rate\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Factory\RateFactoryInterface;
use Evrinoma\ExchangeRateBundle\Mediator\Rate\CommandMediatorInterface;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;
use Evrinoma\ExchangeRateBundle\Repository\Rate\RateCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManagerInterface as TypeQueryManagerInterface;

final class CommandManager implements CommandManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private RateCommandRepositoryInterface $repository;
    private ValidatorInterface             $validator;
    private RateFactoryInterface           $factory;
    private TypeQueryManagerInterface      $typeQueryManager;
    private CommandMediatorInterface       $mediator;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ValidatorInterface             $validator
     * @param RateCommandRepositoryInterface $repository
     * @param RateFactoryInterface           $factory
     * @param CommandMediatorInterface       $mediator
     * @param TypeQueryManagerInterface      $typeQueryManager
     */
    public function __construct(ValidatorInterface $validator, RateCommandRepositoryInterface $repository, RateFactoryInterface $factory, CommandMediatorInterface $mediator, TypeQueryManagerInterface $typeQueryManager)
    {
        $this->validator        = $validator;
        $this->repository       = $repository;
        $this->factory          = $factory;
        $this->mediator         = $mediator;
        $this->typeQueryManager = $typeQueryManager;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateInvalidException
     */
    public function post(RateApiDtoInterface $dto): RateInterface
    {
        $rate = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $rate);

        $errors = $this->validator->validate($rate);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new RateInvalidException($errorsString);
        }

        $this->repository->save($rate);

        return $rate;
    }

    /**
     * @param RateApiDtoInterface $dto
     *
     * @return RateInterface
     * @throws RateInvalidException
     * @throws RateNotFoundException
     */
    public function put(RateApiDtoInterface $dto): RateInterface
    {
        try {
            $rate = $this->repository->find($dto->getId());
        } catch (RateNotFoundException $e) {
            throw $e;
        }

        $rate
            ->setIdentity($dto->getIdentity())
            ->setUpdatedAt(new \DateTimeImmutable());

        $this->mediator->onUpdate($dto, $rate);

        $errors = $this->validator->validate($rate);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new RateInvalidException($errorsString);
        }

        $this->repository->save($rate);

        return $rate;
    }

    /**
     * @param RateApiDtoInterface $dto
     *
     * @throws RateCannotBeRemovedException
     * @throws RateNotFoundException
     */
    public function delete(RateApiDtoInterface $dto): void
    {
        try {
            $rate = $this->repository->find($dto->getId());
        } catch (RateNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $rate);
        try {
            $this->repository->remove($rate);
        } catch (RateCannotBeRemovedException $e) {
            throw $e;
        }
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }
//endregion Getters/Setters
}