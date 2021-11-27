<?php


namespace Evrinoma\ExchangeRateBundle\Constraint\Type;


use Evrinoma\ExchangeRateBundle\Constraint\Common\IdentityTrait;
use Evrinoma\UtilsBundle\Constraint\ConstraintInterface;

final class Identity implements ConstraintInterface
{
    use IdentityTrait;
}