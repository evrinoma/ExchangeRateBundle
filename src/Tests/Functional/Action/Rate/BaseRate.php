<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Action\Rate;

use Evrinoma\ExchangeRateBundle\Dto\RateApiDto;
use Evrinoma\ExchangeRateBundle\Tests\Functional\Action\Type\BaseType;
use Evrinoma\ExchangeRateBundle\Tests\Functional\Helper\BaseRateTestTrait;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use PHPUnit\Framework\Assert;

class BaseRate extends AbstractServiceTest implements BaseRateTestInterface
{
    use BaseRateTestTrait;

//region SECTION: Fields
//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/exchange_rate/rate';
    public const API_CRITERIA = 'evrinoma/api/exchange_rate/rate/criteria';
    public const API_DELETE   = 'evrinoma/api/exchange_rate/rate/delete';
    public const API_PUT      = 'evrinoma/api/exchange_rate/rate/save';
    public const API_POST     = 'evrinoma/api/exchange_rate/rate/create';
//endregion Fields

//region SECTION: Protected
    protected static function getDtoClass(): string
    {
        return RateApiDto::class;
    }
//endregion Protected

//region SECTION: Public
    public static function defaultData(): array
    {
        $base             = BaseType::defaultData();
        $base['id']       = '2';
        $base['identity'] = 'EUR';

        return [
            "id"        => '1',
            "base"      => $base,
            "type"      => BaseType::defaultData(),
            "value"     => "0.846316",
            "timestamp" => "1637935744",
            "class"     => static::getDtoClass(),
        ];

    }

    public function actionPost(): void
    {
        $this->createRate();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteria(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDelete(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPut(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGet(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGetNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
//endregion Public
}