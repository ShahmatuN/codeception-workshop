<?php

namespace Functional;

use Codeception\Util\HttpCode;
use Tests\Support\FunctionalTester;

/**
 * Проверка работоспособности сервера
 */
class HelloCest
{
    private const SCHEMA = ['string'];

    public function sendGetApiPing(FunctionalTester $I)
    {
        $I->wantTo('Проверка работоспособности сервера');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGet('/api/ping');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseMatchesJsonType(self::SCHEMA);
    }
}
