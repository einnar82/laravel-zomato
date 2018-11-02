<?php

namespace RannieOllit\Zomato\Facades;

use Illuminate\Support\Facades\Facade;

class Zomato extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zomato';
    }
}
