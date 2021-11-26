<?php

namespace Evrinoma\ExchangeRateBundle;

use Evrinoma\ExchangeRateBundle\DependencyInjection\EvrinomaExchangeRateExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaExchangeRateBundle extends Bundle
{
//region SECTION: Fields
    public const EXCHANGE_RATE_BUNDLE = 'exchange_rate';

//endregion Fields
//region SECTION: Public
    public function build(ContainerBuilder $container)
    {
        parent::build($container);;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaExchangeRateExtension();
        }

        return $this->extension;
    }
//endregion Getters/Setters


}