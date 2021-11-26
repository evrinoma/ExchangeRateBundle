<?php

namespace Evrinoma\ExchangeRateBundle\Mediator\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeCreatedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;

interface CommandMediatorInterface
{
    /**
     * @param TypeApiDtoInterface $dto
     * @param TypeInterface       $entity
     *
     * @return TypeInterface
     * @throws TypeCannotBeSavedException
     */
    public function onUpdate(TypeApiDtoInterface $dto, TypeInterface $entity): TypeInterface;

    /**
     * @param TypeApiDtoInterface $dto
     * @param TypeInterface       $entity
     *
     * @throws TypeCannotBeRemovedException
     */
    public function onDelete(TypeApiDtoInterface $dto, TypeInterface $entity): void;

    /**
     * @param TypeApiDtoInterface $dto
     * @param TypeInterface       $entity
     *
     * @return TypeInterface
     * @throws TypeCannotBeSavedException
     * @throws TypeCannotBeCreatedException
     */
    public function onCreate(TypeApiDtoInterface $dto, TypeInterface $entity): TypeInterface;
}