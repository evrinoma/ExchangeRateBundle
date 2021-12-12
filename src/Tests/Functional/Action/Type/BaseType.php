<?php

namespace Evrinoma\ExchangeRateBundle\Tests\Functional\Action\Type;

use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Tests\Functional\Helper\BaseTypeTestTrait;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use PHPUnit\Framework\Assert;

class BaseType extends AbstractServiceTest implements BaseTypeTestInterface
{
    use BaseTypeTestTrait;
    public const API_GET      = 'evrinoma/api/exchange_rate/type';
    public const API_CRITERIA = 'evrinoma/api/exchange_rate/type/criteria';
    public const API_DELETE   = 'evrinoma/api/exchange_rate/type/delete';
    public const API_PUT      = 'evrinoma/api/exchange_rate/type/save';
    public const API_POST     = 'evrinoma/api/exchange_rate/type/create';

    public static function defaultData(): array
    {
        return [
            "id"       => '1',
            "identity" => 'RUB',
            "class"    => static::getDtoClass(),
        ];
    }

    public function actionPost(): void
    {
        $this->createType();
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

    public static function getDtoClass(): string
    {
        return TypeApiDto::class;
    }
}