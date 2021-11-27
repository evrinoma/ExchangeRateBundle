<?php

namespace Evrinoma\ExchangeRateBundle\Model;

interface ModelInterface
{
//region SECTION: Fields
    public const ID       = 'id';
    public const CREATED  = 'timestamp';
    public const VALUE    = 'value';
    public const IDENTITY = 'identity';
    public const FROM     = 'from';
    public const TO       = 'to';
//endregion Fields
}