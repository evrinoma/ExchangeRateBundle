<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeCreatedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Factory\TypeFactoryInterface;
use Evrinoma\ExchangeRateBundle\Mediator\Type\CommandMediatorInterface;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\ExchangeRateBundle\Repository\Type\TypeCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private TypeCommandRepositoryInterface $repository;
    private ValidatorInterface             $validator;
    private TypeFactoryInterface           $factory;
    private CommandMediatorInterface $mediator;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ValidatorInterface             $validator
     * @param TypeCommandRepositoryInterface $repository
     * @param TypeFactoryInterface           $factory
     * @param CommandMediatorInterface       $mediator
     */
    public function __construct(ValidatorInterface $validator, TypeCommandRepositoryInterface $repository, TypeFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator  = $validator;
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->mediator   = $mediator;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeInvalidException
     * @throws TypeCannotBeCreatedException
     */
    public function post(TypeApiDtoInterface $dto): TypeInterface
    {
        $type = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $type);

        $errors = $this->validator->validate($type);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new TypeInvalidException($errorsString);
        }

        $this->repository->save($type);

        return $type;
    }

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeInvalidException
     * @throws TypeNotFoundException
     * @throws TypeCannotBeSavedException
     */
    public function put(TypeApiDtoInterface $dto): TypeInterface
    {
        try {
            $type = $this->repository->find($dto->getId());
        } catch (TypeNotFoundException $e) {
            throw $e;
        }

        $type
            ->setIdentity($dto->getIdentity());

        $this->mediator->onUpdate($dto, $type);

        $errors = $this->validator->validate($type);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new TypeInvalidException($errorsString);
        }

        $this->repository->save($type);

        return $type;
    }

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @throws TypeCannotBeRemovedException
     * @throws TypeNotFoundException
     */
    public function delete(TypeApiDtoInterface $dto): void
    {
        try {
            $type = $this->repository->find($dto->getId());
        } catch (TypeNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $type);
        try {
            $this->repository->remove($type);
        } catch (TypeCannotBeRemovedException $e) {
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