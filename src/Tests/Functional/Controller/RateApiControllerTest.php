<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Controller;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDto;
use Evrinoma\ExchangeRateBundle\Fixtures\FixtureInterface;
use Evrinoma\ExchangeRateBundle\Tests\Functional\CaseTest;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ResponseStatusTestTrait;


class RateApiControllerTest extends CaseTest implements ApiControllerTestInterface, ApiBrowserTestInterface, ApiMethodTestInterface
{
//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/exchange_rate/rate';
    public const API_CRITERIA = 'evrinoma/api/exchange_rate/rate/criteria';
    public const API_DELETE   = 'evrinoma/api/exchange_rate/rate/delete';
    public const API_PUT      = 'evrinoma/api/exchange_rate/rate/save';
    public const API_POST     = 'evrinoma/api/exchange_rate/rate/create';
//endregion Fields

    use ApiBrowserTestTrait, ApiMethodTestTrait, ResponseStatusTestTrait;

//region SECTION: Protected
//endregion Protected

//region SECTION: Public
    public static function defaultData(): array
    {
        $base             = TypeApiControllerTest::defaultData();
        $base['id']       = '2';
        $base['identity'] = 'EUR';

        return [
            "id"        => '1',
            "base"      => $base,
            "type"      => TypeApiControllerTest::defaultData(),
            "value"     => "0.846316",
            "timestamp" => "1637935744",
            "class"     => static::getDtoClass(),
        ];

    }

    public function testPost(): void
    {
        $this->createRate();
        $this->testResponseStatusCreated();
    }

    public function testCriteriaNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCriteria(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDelete(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPut(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testGet(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testGetNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDeleteNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDeleteUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPutNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPutUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPostDuplicate(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPostUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
//endregion Public

//region SECTION: Private
    private function createRate(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [FixtureInterface::TYPE_FIXTURES];
    }

    public static function getDtoClass(): string
    {
        return RateApiDto::class;
    }
//endregion Getters/Setters
}
