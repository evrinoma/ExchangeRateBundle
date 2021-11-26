<?php


namespace Evrinoma\ExchangeRateBundle\Entity\Rate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\ExchangeRateBundle\Model\Rate\AbstractRate;
use Evrinoma\UtilsBundle\Entity\IdentityInterface;
use Evrinoma\UtilsBundle\Entity\IdentityTrait;

/**
 * Class BaseRate
 *
 * @ORM\Table(name="eexchange_rate")
 * @ORM\Entity()
 */
class BaseRate extends AbstractRate implements IdentityInterface
{
    use IdentityTrait;
}