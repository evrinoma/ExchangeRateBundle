<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\ExchangeRateBundle\Model\ModelInterface;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdentityTrait;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class TypeApiDto extends AbstractDto implements TypeApiDtoInterface
{
    use IdTrait, IdentityTrait;

//region SECTION: Private
    /**
     * @param string $identity
     */
    private function setIdentity(string $identity): void
    {
        $this->identity = $identity;
    }

    /**
     * @param int|null $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }
//endregion Private

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id       = $request->get(ModelInterface::ID);
            $identity = $request->get(ModelInterface::IDENTITY);

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
