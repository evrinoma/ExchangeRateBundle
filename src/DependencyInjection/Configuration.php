<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection;

use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE);
        $rootNode    = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
//endregion Getters/Setters
}
