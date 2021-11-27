<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\ExchangeRateBundle\Model\ModelInterface;
use Symfony\Component\HttpFoundation\Request;

class RangeApiDto extends AbstractDto implements RangeApiDtoInterface
{
//region SECTION: Fields
    private ?\DateTimeImmutable $from = null;
    private ?\DateTimeImmutable $to   = null;
//endregion Fields

//region SECTION: Public
    /**
     * @return bool
     */
    public function hasRange(): bool
    {
        return $this->getFrom() && $this->hasTo();
    }

    /**
     * @return bool
     */
    public function hasFrom(): bool
    {
        return $this->from !== null;
    }

    /**
     * @return bool
     */
    public function hasTo(): bool
    {
        return $this->to !== null;
    }
//endregion Public

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $from = $request->get(ModelInterface::FROM);
            $to   = $request->get(ModelInterface::TO);

            if ($from) {
                $this->setFrom((new \DateTimeImmutable)->setTimestamp((int)$from));
            }

            if ($to) {
                $this->setTo((new \DateTimeImmutable)->setTimestamp((int)$to));
            }
        }

        return $this;
    }
//endregion SECTION: Dto

//region SECTION: Getters/Setters
    /**
     * @return \DateTimeImmutable|null
     */
    public function getFrom(): ?\DateTimeImmutable
    {
        return $this->from;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getTo(): ?\DateTimeImmutable
    {
        return $this->to;
    }

    /**
     * @param \DateTimeImmutable|null $from
     *
     * @return RangeApiDtoInterface
     */
    public function setFrom(?\DateTimeImmutable $from): RangeApiDtoInterface
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $to
     *
     * @return RangeApiDtoInterface
     */
    public function setTo(?\DateTimeImmutable $to): RangeApiDtoInterface
    {
        $this->to = $to;

        return $this;
    }
//endregion Getters/Setters
}
