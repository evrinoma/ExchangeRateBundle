<?php

namespace Evrinoma\ExchangeRateBundle\Constraint\Common;

use Symfony\Component\Validator\Constraints\NotBlank;

trait IdentityTrait
{
    public function getConstraints(): array
    {
        return [
            new NotBlank(),
        ];
    }

    public function getPropertyName(): string
    {
        return 'identity';
    }
}