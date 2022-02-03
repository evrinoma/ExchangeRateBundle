<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdentityTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class TypeApiDto extends AbstractDto implements TypeApiDtoInterface
{
    use IdTrait, IdentityTrait;

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id       = $request->get(TypeApiDtoInterface::ID);
            $identity = $request->get(TypeApiDtoInterface::IDENTITY);

            if ($identity) {
                $this->setIdentity($identity);
            }

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
//endregion SECTION: Dto
}
