<?php

declare(strict_types=1);

namespace Tests\Support\Page;

use Tests\Support\AcceptanceTester;

class Listing
{
    private const BTN_ANALOG = '[data-qa="product-report-later"], [data-behavior="get-analog"], [data-qa="get-analog-btn"]';
    private const GET_ANALOG_MODAL = '//*[contains(@class,"modal")]//*[contains(text(),"Подобрать аналог")]';

    public function __construct(private AcceptanceTester $tester)
    {
    }

    public function openAnalogListing()
    {
        $this->tester->amOnPage('/category/pily-1348/maktec-663/');
    }

    public function openAnalogPopup()
    {
        $this->tester->waitForElementVisible(self::BTN_ANALOG);
        $this->tester->scrollTo(self::BTN_ANALOG, 0, 450);
        $this->tester->click(self::BTN_ANALOG);
        $this->tester->waitForElementVisible(self::GET_ANALOG_MODAL);
    }
}
