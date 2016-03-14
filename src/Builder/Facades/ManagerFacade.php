<?php namespace WhiteFrame\Helloquent\Builder\Facades;

use Illuminate\Support\Facades\Facade;

class ManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'white-frame.helloquent.builder.manager';
    }
}