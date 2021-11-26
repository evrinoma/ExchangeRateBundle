<?php

namespace Evrinoma\ExchangeRateBundle\Model\Rate;

use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractRate
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="idx_rate", columns={"created_at", "type"})})
 */
abstract class AbstractRate implements RateInterface
{
    use IdTrait, CreateUpdateAtTrait;

//region SECTION: Fields
    /**
     * @var TypeInterface
     *
     * @ORM\ManyToOne(targetEntity="Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected TypeInterface $type;
//endregion Fields

//region SECTION: Getters/Setters
      /**
     * @return TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @param TypeInterface $type
     *
     * @return RateInterface
     */
    public function setType(TypeInterface $type): RateInterface
    {
        $this->type = $type;

        return $this;
    }
//endregion Getters/Setters
}
