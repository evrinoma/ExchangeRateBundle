<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection\Compiler\Constraint;


use Evrinoma\ExchangeRateBundle\Validator\TypeValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TypePass extends AbstractConstraint implements CompilerPassInterface
{
    public const EXCHANGE_RATE_TYPE_CONSTRAINT = 'evrinoma.exchange_rate.constraint.type';

    protected static string $alias = self::EXCHANGE_RATE_TYPE_CONSTRAINT;
    protected static string $class = TypeValidator::class;
    protected static string $methodCall = 'addConstraint';
}