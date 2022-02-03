<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class RateApiDto extends AbstractDto implements RateApiDtoInterface
{
    use IdTrait;

//region SECTION: Fields
    /**
     * @Dto(class="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto", generator="genRequestBaseApiDto")
     * @var TypeApiDto|null
     */
    private ?TypeApiDto $baseApiDto = null;

    /**
     * @Dto(class="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto", generator="genRequestTypeApiDto")
     * @var TypeApiDto|null
     */
    private ?TypeApiDto $typeApiDto = null;

    /**
     * @Dto(class="Evrinoma\ExchangeRateBundle\Dto\RangeApiDto", generator="genRequestRangeApiDto")
     * @var RangeApiDto|null
     */
    private ?RangeApiDto $rangeApiDto = null;

    private ?float $value = null;

    private ?\DateTimeImmutable $created = null;
//endregion Fields

//region SECTION: Protected
    /**
     * @param float $value
     *
     * @return DtoInterface
     */
    protected function setValue(float $value): DtoInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $created
     *
     * @return DtoInterface
     */
    protected function setCreated(\DateTimeImmutable $created): DtoInterface
    {
        $this->created = $created;

        return $this;
    }
//endregion Protected

//region SECTION: Public
    /**
     * @return bool
     */
    public function hasCreated(): bool
    {
        return $this->created !== null;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return $this->value !== null;
    }
//endregion Public

//region SECTION: Dto
    /**
     * @return \Generator
     */
    public function genRequestTypeApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $type = $request->get(TypeApiDtoInterface::TYPE);
            if ($type) {
                $newRequest                    = $this->getCloneRequest();
                $type[DtoInterface::DTO_CLASS] = TypeApiDto::class;
                $newRequest->request->add($type);

                yield $newRequest;
            }
        }
    }

    /**
     * @return \Generator
     */
    public function genRequestBaseApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $type = $request->get(TypeApiDtoInterface::BASE);
            if ($type) {
                $newRequest                    = $this->getCloneRequest();
                $type[DtoInterface::DTO_CLASS] = TypeApiDto::class;
                $newRequest->request->add($type);

                yield $newRequest;
            }
        }
    }

    /**
     * @return \Generator
     */
    public function genRequestRangeApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $type = $request->get(RangeApiDtoInterface::RANGE);
            if ($type) {
                $newRequest                    = $this->getCloneRequest();
                $type[DtoInterface::DTO_CLASS] = RangeApiDto::class;
                $newRequest->request->add($type);

                yield $newRequest;
            }
        }
    }

    /**
     * @return bool
     */
    public function hasBaseApiDto(): bool
    {
        return $this->baseApiDto !== null;
    }

    /**
     * @return bool
     */
    public function hasTypApiDto(): bool
    {
        return $this->typeApiDto !== null;
    }

    /**
     * @return bool
     */
    public function hasRangeApiDto(): bool
    {
        return $this->rangeApiDto !== null;
    }

    /**
     * @param RangeApiDtoInterface|null $rangeApiDto
     *
     * @return DtoInterface
     */
    public function setRangeApiDto(?RangeApiDtoInterface $rangeApiDto): DtoInterface
    {
        $this->rangeApiDto = $rangeApiDto;

        return $this;
    }

    /**
     * @param TypeApiDtoInterface|null $baseApiDto
     *
     * @return DtoInterface
     */
    public function setBaseApiDto(?TypeApiDtoInterface $baseApiDto): DtoInterface
    {
        $this->baseApiDto = $baseApiDto;

        return $this;
    }

    /**
     * @param TypeApiDtoInterface|null $typeApiDto
     *
     * @return DtoInterface
     */
    public function setTypeApiDto(?TypeApiDtoInterface $typeApiDto): DtoInterface
    {
        $this->typeApiDto = $typeApiDto;

        return $this;
    }

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id      = $request->get(RateApiDtoInterface::ID);
            $created = $request->get(RateApiDtoInterface::CREATED);
            $value   = $request->get(RateApiDtoInterface::VALUE);

            if ($created) {
                $this->setCreated((new \DateTimeImmutable)->setTimestamp((int)$created));
            }

            if ($value) {
                $this->setValue((float)\str_replace(',', '.', $value));
            }

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }

    public function getBaseApiDto(): TypeApiDtoInterface
    {
        return $this->baseApiDto;
    }

    public function getTypeApiDto(): TypeApiDtoInterface
    {
        return $this->typeApiDto;
    }

    public function getRangeApiDto(): RangeApiDtoInterface
    {
        return $this->rangeApiDto;
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    public function getValue(): ?float
    {
        return $this->value;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }
//endregion Getters/Setters
}
