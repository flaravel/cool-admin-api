<?php

namespace Cool\Constructs;
use Illuminate\Database\Eloquent\Builder;

interface CurdInterface
{
    /**
     * @return Builder
     */
    public function model():Builder;

    /**
     * @return string
     */
    public function resource():string;
}
