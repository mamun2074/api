<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \App\Services\AppResponseSerive
 */

class AppResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'app-response';
    }
}
