<?php


namespace Evrinoma\ExchangeRateBundle\Model\Rate;

use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface RateInterface extends CreateUpdateAtInterface, IdInterface
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
//endregion Getters/Setters
}