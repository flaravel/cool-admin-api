<?php

namespace Cool\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class AdminUser extends Authenticatable implements JWTSubject
{
    public $guarded = [];

    public $hidden = ['password'];

    public $fillable = [
        'department_id', 'name', 'username', 'password', 'avatar', 'email', 'status', 'nick_name', 'phone', 'remark'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }


    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(AdminDepartment::class);
    }

    /**
     * @return HasMany
     */
    public function adminRole(): HasMany
    {
        return $this->hasMany(AdminUserRole::class, 'user_id');
    }


    /**
     * @return HasManyThrough
     */
    public function role(): HasManyThrough
    {
        return $this->hasManyThrough(AdminRole::class, AdminUserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    /**
     * @return void
     */
    public function attachRole(array $roleIds)
    {
        $this->adminRole()->delete();
        foreach ($roleIds as $roleId) {
            $this->adminRole()->create([
                'role_id' => $roleId
            ]);
        }
    }

    /**
     * @return string
     */
    public function getRoleString(): string
    {
        return $this->role()->get()->pluck('name')->implode(',');
    }

    /**
     * @return array
     */
    public function getRoleIds(): array
    {
        return $this->role()->get()->pluck('id')->toArray();
    }

    /**
     * @return array
     */
    public function getPerms(): array
    {
        $roles = $this->role()->get();
        $perms = [];
        foreach ($roles as $role) {
            $perms += $role->getMenuPerms();
        }
        return $perms;
    }

    /**
     * @return array
     */
    public function getMenus()
    {
        $roles = $this->role()->get();
        $menuIds = [];
        foreach ($roles as $role) {
            $menuIds += $role->getMenuIds();
        }
        $menuIds = array_unique($menuIds);

        return AdminMenu::query()->whereIn('id', $menuIds)->get();
    }
}
