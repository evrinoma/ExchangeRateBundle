<?php

namespace Evrinoma\ExchangeRateBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\ExchangeRateBundle\Entity\Type\BaseType;

final class TypeFixtures extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{
//region SECTION: Fields
    private array $data = [
        ['identity' => 'RUB'],
        ['identity' => 'EUR'],
        ['identity' => 'GBP'],
        ['identity' => 'RWF'],
        ['identity' => 'USD'],
        ['identity' => 'JPY'],
    ];
//endregion Fields

//region SECTION: Public
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createTypes($manager);

        $manager->flush();
    }
//endregion Public
//endregion Public

//region SECTION: Private
    private function createTypes(ObjectManager $manager)
    {
        $short = (new \ReflectionClass(BaseType::class))->getShortName()."_";
        $i     = 0;

        foreach ($this->data as $record) {
            $entity = new BaseType();
            $entity->setIdentity($record['identity']);
            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            $i++;
        }

        return $this;
    }

//endregion Private

//region SECTION: Getters/Setters
    public static function getGroups(): array
    {
        return [
            FixtureInterface::TYPE_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}