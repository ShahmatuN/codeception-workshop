<?php

namespace Tests\Support\Helper;

use Codeception\Module\WebDriver;
use Codeception\TestInterface;

class Acceptance extends WebDriver
{
    public function _before(TestInterface $test)
    {
        echo 'Hello';
        parent::_before($test);
    }
}
