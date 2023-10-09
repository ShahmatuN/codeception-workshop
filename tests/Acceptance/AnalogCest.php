<?php

namespace Acceptance;

use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Listing;

class AnalogCest
{
    public function analogValidation(Listing $listing)
    {
        $listing->openAnalogListing();
        $listing->openAnalogPopup();
    }
}
