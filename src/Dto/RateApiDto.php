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

    private ?float $value = null;

    private ?\DateTimeImmutable $created = null;
//endregion Fields

//region SECTION: Protected
    /**
     * @param float $value
     */
    protected function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @param \DateTimeImmutable|null $created
     */
    protected function setCreated(\DateTimeImmutable $created): void
    {
        $this->created = $created;
    }
//endregion Protected

//region SECTION: Private
    /**
     * @param int|null $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
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
     * @param TypeApiDto|null $baseApiDto
     */
    public function setBaseApiDto(?TypeApiDto $baseApiDto): void
    {
        $this->baseApiDto = $baseApiDto;
    }

    /**
     * @param TypeApiDto|null $typeApiDto
     */
    public function setTypeApiDto(?TypeApiDto $typeApiDto): void
    {
        $this->typeApiDto = $typeApiDto;
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
