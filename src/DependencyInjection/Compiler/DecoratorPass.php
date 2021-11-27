<?php

namespace Evrinoma\EvrinomaExchangeRateBundle\DependencyInjection\Compiler;


use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorPass extends AbstractRecursivePass
{
//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.decorates.rate.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository    = $container->getDefinition('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.rate.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.decorates.rate.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager  = $container->getDefinition('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.rate.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }

        $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.decorates.type.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository    = $container->getDefinition('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.type.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.decorates.type.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager  = $container->getDefinition('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.type.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
    }
}