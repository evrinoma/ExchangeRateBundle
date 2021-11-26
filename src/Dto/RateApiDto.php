<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class RateApiDto extends AbstractDto implements RateApiDtoInterface
{
    use IdTrait;


//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {

        }

        return $this;
    }
//endregion SECTION: Dto
}
