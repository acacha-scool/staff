<?php

namespace Acacha\Scool\Staff\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ScoolStaff.
 */
class ScoolStaff extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ScoolStaff';
    }
}
