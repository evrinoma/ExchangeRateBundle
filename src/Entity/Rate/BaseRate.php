<?php


namespace Evrinoma\ExchangeRateBundle\Entity\Rate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\ExchangeRateBundle\Model\Rate\AbstractRate;

/**
 * Class BaseRate
 *
 * @ORM\Table(name="eexchange_rate")
 * @ORM\Entity()
 */
class BaseRate extends AbstractRate
{
}