<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Controller;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ResponseStatusTestTrait;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;

class TypeApiControllerTest extends AbstractWebCaseTest implements ApiControllerTestInterface, ApiBrowserTestInterface, ApiMethodTestInterface
{
//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/exchange_rate/type';
    public const API_CRITERIA = 'evrinoma/api/exchange_rate/type/criteria';
    public const API_DELETE   = 'evrinoma/api/exchange_rate/type/delete';
    public const API_PUT      = 'evrinoma/api/exchange_rate/type/save';
    public const API_POST     = 'evrinoma/api/exchange_rate/type/create';
//endregion Fields

    use ApiBrowserTestTrait, ApiMethodTestTrait, ResponseStatusTestTrait;

//region SECTION: Protected
//endregion Protected

//region SECTION: Public
    public static function defaultData(): array
    {
        return [
            "id"       => '1',
            "identity" => 'RUB',
            "class"    => static::getDtoClass(),
        ];
    }

    public function testPost(): void
    {
        $this->createType();
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
    private function createType(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [];
    }

    public static function getDtoClass(): string
    {
        return TypeApiDto::class;
    }
//endregion Getters/Setters
}
