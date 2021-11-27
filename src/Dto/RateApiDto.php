<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Evrinoma\ExchangeRateBundle\Model\ModelInterface;
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
     * @return RateApiDtoInterface
     */
    protected function setValue(float $value): RateApiDtoInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $created
     *
     * @return RateApiDtoInterface
     */
    protected function setCreated(\DateTimeImmutable $created): RateApiDtoInterface
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

//region SECTION: Private
    /**
     * @param int|null $id
     *
     * @return RateApiDtoInterface
     */
    private function setId(?int $id): RateApiDtoInterface
    {
        $this->id = $id;

        return $this;
    }
//endregion Private

//region SECTION: Dto
    /**
     * @return \Generator
     */
    public function genRequestTypeApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $type = $request->get('type');
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
            $type = $request->get('base');
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
            $type = $request->get('range');
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
     * @param RangeApiDto|null $rangeApiDto
     *
     * @return RateApiDtoInterface
     */
    public function setRangeApiDto(?RangeApiDto $rangeApiDto): RateApiDtoInterface
    {
        $this->rangeApiDto = $rangeApiDto;

        return $this;
    }

    /**
     * @param TypeApiDto|null $baseApiDto
     *
     * @return RateApiDtoInterface
     */
    public function setBaseApiDto(?TypeApiDto $baseApiDto): RateApiDtoInterface
    {
        $this->baseApiDto = $baseApiDto;

        return $this;
    }

    /**
     * @param TypeApiDto|null $typeApiDto
     *
     * @return RateApiDtoInterface
     */
    public function setTypeApiDto(?TypeApiDto $typeApiDto): RateApiDtoInterface
    {
        $this->typeApiDto = $typeApiDto;

        return $this;
    }

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id      = $request->get(ModelInterface::ID);
            $created = $request->get(ModelInterface::CREATED);
            $value   = $request->get(ModelInterface::VALUE);

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
