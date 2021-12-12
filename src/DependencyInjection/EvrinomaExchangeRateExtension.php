<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection;


use Evrinoma\ExchangeRateBundle\DependencyInjection\Compiler\Constraint\RatePass;
use Evrinoma\ExchangeRateBundle\DependencyInjection\Compiler\Constraint\TypePass;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Evrinoma\UtilsBundle\DependencyInjection\HelperTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class EvrinomaExchangeRateExtension extends Extension
{
    use HelperTrait;

//region SECTION: Fields
    public const ENTITY           = 'Evrinoma\ExchangeRateBundle\Entity';
    public const FACTORY_RATE     = 'Evrinoma\ExchangeRateBundle\Factory\RateFactory';
    public const FACTORY_TYPE     = 'Evrinoma\ExchangeRateBundle\Factory\TypeFactory';
    public const ENTITY_BASE_RATE = self::ENTITY.'\Rate\BaseRate';
    public const ENTITY_BASE_TYPE = self::ENTITY.'\Type\BaseType';
    public const DTO_BASE_RATE    = RateApiDto::class;
    public const DTO_BASE_TYPE    = TypeApiDto::class;
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
        $loader->load('command.yml');

        if ($container->getParameter('kernel.environment') !== 'prod') {
            $loader->load('fixtures.yml');
        }

        if ($container->getParameter('kernel.environment') === 'test') {
            $loader->load('tests.yml');
        }

        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        if ($config['factory_rate'] !== self::FACTORY_RATE) {
            $this->wireFactory($container, 'rate', $config['factory_rate'], $config['entity_rate']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.rate.factory');
            $definitionFactory->setArgument(0, $config['entity_rate']);
        }

        if ($config['factory_type'] !== self::FACTORY_TYPE) {
            $this->wireFactory($container, 'type', $config['factory_type'], $config['entity_type']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.type.factory');
            $definitionFactory->setArgument(0, $config['entity_type']);
        }


        $doctrineRegistry = null;

        if (isset(self::$doctrineDrivers[$config['db_driver']])) {
            $loader->load('doctrine.yml');
            $container->setAlias('evrinoma.'.$this->getAlias().'.doctrine_registry', new Alias(self::$doctrineDrivers[$config['db_driver']]['registry'], false));
            $doctrineRegistry = new Reference('evrinoma.'.$this->getAlias().'.doctrine_registry');
            $container->setParameter('evrinoma.'.$this->getAlias().'.backend_type_'.$config['db_driver'], true);
            $objectManager = $container->getDefinition('evrinoma.'.$this->getAlias().'.object_manager');
            $objectManager->setFactory([$doctrineRegistry, 'getManager']);
        }

        $this->remapParametersNamespaces(
            $container,
            $config,
            [
                '' => [
                    'db_driver'   => 'evrinoma.'.$this->getAlias().'.storage',
                    'entity_rate' => 'evrinoma.'.$this->getAlias().'.entity_rate',
                    'entity_type' => 'evrinoma.'.$this->getAlias().'.entity_type',
                ],
            ]
        );

        if ($doctrineRegistry) {
            $this->wireRepository($container, $doctrineRegistry, 'rate', $config['entity_rate']);
            $this->wireRepository($container, $doctrineRegistry, 'type', $config['entity_type']);
        }

        $this->wireController($container, 'rate', $config['dto_rate']);
        $this->wireController($container, 'type', $config['dto_type']);

        $this->wireValidator($container, 'rate', $config['entity_rate']);
        $this->wireValidator($container, 'type', $config['entity_type']);

        $loader->load('validation.yml');

        if ($config['constraints_rate']) {
            $loader->load('constraint/rate.yml');
        }

        if ($config['constraints_type']) {
            $loader->load('constraint/type.yml');
        }


        $this->wireConstraintTag($container);

        if ($config['decorates']) {
            $this->remapParametersNamespaces(
                $container,
                $config['decorates'],
                [
                    '' => [
                        'command_rate' => 'evrinoma.'.$this->getAlias().'.decorates.rate.command',
                        'query_rate'   => 'evrinoma.'.$this->getAlias().'.decorates.rate.query',
                        'command_type' => 'evrinoma.'.$this->getAlias().'.decorates.type.command',
                        'query_type'   => 'evrinoma.'.$this->getAlias().'.decorates.type.query',
                    ],
                ]
            );
        }
    }
//endregion Public

//region SECTION: Private
    private function wireConstraintTag(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $key => $definition) {
            switch (true) {
                case strpos($key, TypePass::EXCHANGE_RATE_TYPE_CONSTRAINT) !== false :
                    $definition->addTag(TypePass::EXCHANGE_RATE_TYPE_CONSTRAINT);
                    break;
                case strpos($key, RatePass::EXCHANGE_RATE_RATE_CONSTRAINT) !== false :
                    $definition->addTag(RatePass::EXCHANGE_RATE_RATE_CONSTRAINT);
                    break;
            }
        }
    }

    private function wireFactory(ContainerBuilder $container, string $name, string $class, string $paramClass): void
    {
        $container->removeDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.factory');
        $definitionFactory = new Definition($class);
        $definitionFactory->addArgument($paramClass);
        $alias = new Alias('evrinoma.'.$this->getAlias().'.'.$name.'.factory');
        $container->addDefinitions(['evrinoma.'.$this->getAlias().'.'.$name.'.factory' => $definitionFactory]);
        $container->addAliases([$class => $alias]);
    }

    private function wireController(ContainerBuilder $container, string $name, string $class): void
    {
        $definitionApiController = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.api.controller');
        $definitionApiController->setArgument(5, $class);
    }

    private function wireValidator(ContainerBuilder $container, string $name, string $class): void
    {
        $definitionApiController = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.validator');
        $definitionApiController->setArgument(0, $class);
    }

    private function wireRepository(ContainerBuilder $container, Reference $doctrineRegistry, string $name, string $class): void
    {
        $definitionRepository    = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.repository');
        $definitionQueryMediator = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.query.mediator');
        $definitionRepository->setArgument(2, $definitionQueryMediator);
        $definitionRepository->setArgument(1, $class);
        $definitionRepository->setArgument(0, $doctrineRegistry);

        $array = $definitionRepository->getArguments();
        ksort($array);
        $definitionRepository->setArguments($array);
    }
//endregion Private

//region SECTION: Getters/Setters
    public function getAlias()
    {
        return EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE;
    }
//endregion Getters/Setters
}