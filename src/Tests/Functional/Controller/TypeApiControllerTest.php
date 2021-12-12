<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Controller;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\AbstractFunctionalTest;
use Psr\Container\ContainerInterface;


final class TypeApiControllerTest extends AbstractFunctionalTest
{
//region SECTION: Fields
    protected string $actionServiceName = 'evrinoma.exchange_rate.test.functional.action.type';
//endregion Fields

//region SECTION: Protected
    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }
//endregion Protected

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [];
    }
//endregion Getters/Setters
}