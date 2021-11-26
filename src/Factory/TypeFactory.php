<?php

namespace Evrinoma\ExchangeRateBundle\Factory;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Entity\Type\BaseType;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;

final class TypeFactory implements TypeFactoryInterface
{
    private static string $entityClass = BaseType::class;

    public function create(TypeApiDtoInterface $dto): TypeInterface
    {
        /** @var BaseType $type */
        $type = new self::$entityClass;

        $type
            ->setIdentity($dto->getIdentity());

        return $type;
    }
}