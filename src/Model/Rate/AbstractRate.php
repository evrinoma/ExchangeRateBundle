<?php

namespace Evrinoma\ExchangeRateBundle\Model\Rate;

use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdentityTrait;
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
    use IdTrait, CreateUpdateAtTrait, IdentityTrait;

//region SECTION: Fields
    /**
     * @var TypeInterface
     *
     * @ORM\ManyToOne(targetEntity="Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface")
     * @ORM\JoinColumn(name="base_id", referencedColumnName="id")
     */
    protected TypeInterface $base;

    /**
     * @var TypeInterface
     *
     * @ORM\ManyToOne(targetEntity="Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected TypeInterface $type;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="decimal", precision=20, scale=6)
     */
    protected float $value;
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

    /**
     * @return TypeInterface
     */
    public function getBase(): TypeInterface
    {
        return $this->base;
    }

    /**
     * @param TypeInterface $base
     *
     * @return RateInterface
     */
    public function setBase(TypeInterface $base): RateInterface
    {
        $this->base = $base;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return RateInterface
     */
    public function setValue(float $value): RateInterface
    {
        $this->value = $value;

        return $this;
    }
//endregion Getters/Setters
}
