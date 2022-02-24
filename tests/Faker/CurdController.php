<?php

namespace Tests\Faker;

use Cool\Controllers\CoolBaseController;
use Illuminate\Database\Eloquent\Builder;

class CurdController extends CoolBaseController
{

    public function resource(): string
    {

    }

    public function model(): Builder
    {
        return new Builder();
    }
}
