<?php

namespace Denitsa\ShitGotDone;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Denitsa\ShitGotDone\Skeleton\SkeletonClass
 */
class ShitGotDoneFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shit-got-done';
    }
}
