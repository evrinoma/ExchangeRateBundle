<?php

namespace Evrinoma\ExchangeRateBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\IdentityTrait;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Evrinoma\ExchangeRateBundle\Model\ModelInterface;
use Symfony\Component\HttpFoundation\Request;

class TypeApiDto extends AbstractDto implements TypeApiDtoInterface
{
    use IdTrait, IdentityTrait;

//region SECTION: Protected

    /**
     * @param string $identity
     *
     * @return TypeApiDtoInterface
     */
    protected function setIdentity(string $identity): TypeApiDtoInterface
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * @param int|null $id
     *
     * @return TypeApiDtoInterface
     */
    protected function setId(?int $id): TypeApiDtoInterface
    {
        $this->id = $id;

        return $this;
    }
//endregion Protected

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
