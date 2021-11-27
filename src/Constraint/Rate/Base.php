<?php


namespace Evrinoma\ExchangeRateBundle\Constraint\Rate;

use Evrinoma\ExchangeRateBundle\Constraint\Common\TypeTrait;
use Evrinoma\UtilsBundle\Constraint\ConstraintInterface;

final class Base implements ConstraintInterface
{
    use TypeTrait;

//region SECTION: Getters/Setters
    public function getPropertyName(): string
    {
        return 'base';
    }
//endregion Getters/Setters
}