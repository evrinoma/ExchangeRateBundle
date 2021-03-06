<?php

namespace Evrinoma\ExchangeRateBundle\Form\Rest;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManagerInterface;
use Evrinoma\UtilsBundle\Form\Rest\RestChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeChoiceType extends AbstractType
{

//region SECTION: Fields
    private QueryManagerInterface $queryManager;
//endregion Fields

//region SECTION: Constructor
    public function __construct(QueryManagerInterface $queryManager)
    {
        $this->queryManager = $queryManager;
    }
//endregion Constructor

//region SECTION: Public
    public function configureOptions(OptionsResolver $resolver)
    {
        $callback = function (Options $options) {
            $value = [];
            try {
                if ($options->offsetExists('data')) {
                    $criteria = $this->queryManager->criteria(new TypeApiDto());
                    switch($options->offsetGet('data')) {
                        case  TypeApiDtoInterface::IDENTITY:
                            foreach ($criteria as $entity) {
                                $value[] = $entity->getIdentity();
                            }
                            break;
                        default:
                            foreach ($criteria as $entity) {
                                $value[] = $entity->getId();
                            }
                    }
                } else {
                    throw new TypeNotFoundException();
                }
            } catch (TypeNotFoundException $e) {
                $value = RestChoiceType::REST_CHOICES_DEFAULT;
            }

            return $value;
        };
        $resolver->setDefault(RestChoiceType::REST_COMPONENT_NAME, 'type');
        $resolver->setDefault(RestChoiceType::REST_DESCRIPTION, 'typeList');
        $resolver->setDefault(RestChoiceType::REST_CHOICES, $callback);
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getParent()
    {
        return RestChoiceType::class;
    }
//endregion Getters/Setters
}