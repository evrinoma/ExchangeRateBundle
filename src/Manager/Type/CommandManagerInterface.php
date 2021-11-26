<?php

namespace Evrinoma\ExchangeRateBundle\Manager\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeRemovedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;


interface CommandManagerInterface
{
//region SECTION: Public
    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeInvalidException
     */
    public function post(TypeApiDtoInterface $dto): TypeInterface;

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @return TypeInterface
     * @throws TypeInvalidException
     * @throws TypeNotFoundException
     */
    public function put(TypeApiDtoInterface $dto): TypeInterface;

    /**
     * @param TypeApiDtoInterface $dto
     *
     * @throws TypeCannotBeRemovedException
     * @throws TypeNotFoundException
     */
    public function delete(TypeApiDtoInterface $dto): void;
//endregion Public
}