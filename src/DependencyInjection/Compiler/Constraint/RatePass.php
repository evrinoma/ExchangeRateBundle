<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection\Compiler\Constraint;


use Evrinoma\ExchangeRateBundle\Validator\RateValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RatePass extends AbstractConstraint implements CompilerPassInterface
{
    public const EXCHANGE_RATE_RATE_CONSTRAINT = 'evrinoma.exchange_rate.constraint.owner';

    protected static string $alias = self::EXCHANGE_RATE_RATE_CONSTRAINT;
    protected static string $class = RateValidator::class;
    protected static string $methodCall = 'addConstraint';
}