<?php

namespace Denitsa\ShitGotDone\Tests;

use Orchestra\Testbench\TestCase;
use Denitsa\ShitGotDone\ShitGotDoneServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ShitGotDoneServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
