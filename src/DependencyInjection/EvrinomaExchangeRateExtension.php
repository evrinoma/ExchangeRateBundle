<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection;


use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Evrinoma\UtilsBundle\DependencyInjection\HelperTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvrinomaExchangeRateExtension extends Extension
{
    use HelperTrait;

//region SECTION: Fields
    public const ENTITY = 'Evrinoma\ExchangeRateBundle\Entity';
    /**
     * @var array
     */
    private static array $doctrineDrivers = array(
        'orm' => array(
            'registry' => 'doctrine',
            'tag'      => 'doctrine.event_subscriber',
        ),
    );
//endregion Fields

//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

    }
//endregion Public


//region SECTION: Getters/Setters
    public function getAlias()
    {
        return EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE;
    }
//endregion Getters/Setters
}