<?php

namespace Evrinoma\ExchangeRateBundle\Factory;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Entity\Rate\BaseRate;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;

final class RateFactory implements RateFactoryInterface
{
//region SECTION: Fields
    private static string $entityClass = BaseRate::class;
//endregion Fields

//region SECTION: Public
    public function create(RateApiDtoInterface $dto): RateInterface
    {
        /** @var BaseRate $rate */
        $rate = new self::$entityClass;

        $rate
            ->setCreated($dto->getCreated())
            ->setValue($dto->getValue())
            ->setCreatedAt(new \DateTimeImmutable())
            ;

        return $rate;
    }
//endregion Public
}