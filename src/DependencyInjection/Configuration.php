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
        $treeBuilder      = new TreeBuilder(EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE);
        $rootNode         = $treeBuilder->getRootNode();
        $supportedDrivers = ['orm'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('orm')
            ->end()
            ->scalarNode('factory_rate')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::FACTORY_RATE)->end()
            ->scalarNode('factory_type')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::FACTORY_TYPE)->end()
            ->scalarNode('entity_type')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::ENTITY_BASE_TYPE)->end()
            ->scalarNode('entity_rate')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::ENTITY_BASE_RATE)->end()
            ->scalarNode('constraints_type')->defaultTrue()->info('This option is used for enable/disable basic type constraints')->end()
            ->scalarNode('constraints_rate')->defaultTrue()->info('This option is used for enable/disable basic rate constraints')->end()
            ->scalarNode('dto_type')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::DTO_BASE_TYPE)->info('This option is used for dto class override')->end()
            ->scalarNode('dto_rate')->cannotBeEmpty()->defaultValue(EvrinomaExchangeRateExtension::DTO_BASE_RATE)->info('This option is used for dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command_type')->defaultNull()->info('This option is used for command type decoration')->end()
            ->scalarNode('query_type')->defaultNull()->info('This option is used for query type decoration')->end()
            ->scalarNode('command_rate')->defaultNull()->info('This option is used for command rate decoration')->end()
            ->scalarNode('query_rate')->defaultNull()->info('This option is used for query rate decoration')->end()
            ->end()->end()->end();

        return $treeBuilder;
    }
//endregion Getters/Setters
}
