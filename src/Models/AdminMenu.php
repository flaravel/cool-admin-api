<?php

namespace Cool\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'parent_id', 'name', 'router', 'perms', 'type', 'icon', 'order_num', 'view_path', 'keep_alive', 'is_show'
    ];

    protected $casts = [
        'is_show' => 'boolean',
        'keep_alive' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(AdminMenu::class, 'parent_id');
    }
}
