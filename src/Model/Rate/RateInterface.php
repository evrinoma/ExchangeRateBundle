<?php


namespace Evrinoma\ExchangeRateBundle\Model\Rate;

use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdentityInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface RateInterface extends CreateUpdateAtInterface, IdInterface, IdentityInterface
{
//region SECTION: Getters/Setters
    /**
     * @return TypeInterface
     */
    public function getType(): TypeInterface;

    /**
     * @param TypeInterface $type
     *
     * @return RateInterface
     */
    public function setType(TypeInterface $type): RateInterface;

    /**
     * @return TypeInterface
     */
    public function getBase(): TypeInterface;

    /**
     * @param TypeInterface $base
     *
     * @return RateInterface
     */
    public function setBase(TypeInterface $base): RateInterface;

    /**
     * @return float
     */
    public function getValue(): float;

    /**
     * @param float $value
     *
     * @return RateInterface
     */
    public function setValue(float $value): RateInterface;

//endregion Getters/Setters
}