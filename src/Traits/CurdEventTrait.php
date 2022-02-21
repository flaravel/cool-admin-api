<?php

namespace Cool\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait CurdEventTrait
{
    /**
     * @param Builder $query
     * @param Request $request
     */
    protected function queryWhere(Builder $query, Request $request)
    {
        //
    }


    /**
     * @param $model
     */
    protected function deleting($model)
    {
        //
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function updated($model, Request $request)
    {
        //
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function created($model, Request $request)
    {
        //
    }

    /**
     * @return string
     */
    public function resource(): string
    {
        return '';
    }
}
