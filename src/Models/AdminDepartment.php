<?php

namespace Cool\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class AdminDepartment extends Model
{

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(AdminDepartment::class, 'parent_id');
    }
}
