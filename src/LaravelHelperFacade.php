<?php

namespace CleaniqueCoders\LaravelHelper;

/*
 * This file is part of laravel-helper
 *
 * @license MIT
 * @package laravel-helper
 */

use Illuminate\Support\Facades\Facade;

class LaravelHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelHelper';
    }
}
