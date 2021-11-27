<?php


namespace Evrinoma\ExchangeRateBundle\Validator;

use Evrinoma\ExchangeRateBundle\Entity\Rate\BaseRate;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;

final class RateValidator extends AbstractValidator
{
//region SECTION: Fields
    /**
     * @var string|null
     */
    protected static ?string $entityClass = BaseRate::class;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param string $entityClass
     */
    public function __construct(string $entityClass)
    {
        parent::__construct($entityClass);
    }
//endregion Constructor
}