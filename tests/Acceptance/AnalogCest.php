<?php

namespace Acceptance;

use Tests\Support\AcceptanceTester;

class AnalogCest
{
    private const BTN_ANALOG = '[data-qa="product-report-later"], [data-behavior="get-analog"], [data-qa="get-analog-btn"]';
    private const GET_ANALOG_MODAL = '//*[contains(@class,"modal")]//*[contains(text(),"Подобрать аналог")]';

    public function analogValidation(AcceptanceTester $I)
    {
        $I->amOnPage('/category/pily-1348/maktec-663/');
        $I->waitForElementVisible(self::BTN_ANALOG);
        $I->scrollTo(self::BTN_ANALOG);
        $I->click(self::BTN_ANALOG);
        $I->waitForElementVisible(self::GET_ANALOG_MODAL);
    }
}
