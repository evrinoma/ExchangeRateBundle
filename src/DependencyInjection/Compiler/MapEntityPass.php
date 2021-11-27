<?php

namespace Evrinoma\ExchangeRateBundle\DependencyInjection\Compiler;

use Evrinoma\ExchangeRateBundle\DependencyInjection\EvrinomaExchangeRateExtension;
use Evrinoma\ExchangeRateBundle\Entity\Rate\BaseRate;
use Evrinoma\ExchangeRateBundle\Entity\Type\BaseType;
use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Evrinoma\ExchangeRateBundle\Model\Rate\RateInterface;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $this->setContainer($container);

        $driver                    = $container->findDefinition('doctrine.orm.default_metadata_driver');
        $referenceAnnotationReader = new Reference('annotations.reader');

        $this->cleanMetadata($driver, [EvrinomaExchangeRateExtension::ENTITY]);

        $entityType = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.entity_type');

        if ((strpos($entityType, EvrinomaExchangeRateExtension::ENTITY) !== false)) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Code', '%s/Entity/Type');
            $this->addResolveTargetEntity([BaseType::class => TypeInterface::class,], false);
        }

        $entityRate = $container->getParameter('evrinoma.'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.'.entity_rate');

        if ((strpos($entityRate, EvrinomaExchangeRateExtension::ENTITY) !== false)) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Bind', '%s/Entity/Rate');
            $this->addResolveTargetEntity([BaseRate::class => RateInterface::class,], false);
        }
    }


//endregion Private
}