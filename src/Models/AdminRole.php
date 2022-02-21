<?php

namespace Cool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminRole extends Model
{
    use SoftDeletes;

   protected $guarded = [];


    /**
     * @return HasMany
     */
   public function roleMenus(): HasMany
   {
       return $this->hasMany(AdminRoleMenu::class, 'role_id');
   }

    /**
     * @return HasMany
     */
    public function roleDepartments(): HasMany
    {
        return $this->hasMany(AdminRoleDepartment::class, 'role_id');
    }

    /**
     * @param array $menuIds
     */
    public function attachMenus(array $menuIds)
    {
        $this->roleMenus()->delete();
        foreach ($menuIds as $menuId) {
            $this->roleMenus()->firstOrCreate([
                'menu_id' => $menuId
            ]);
        }
    }

    /**
     * @param array $departmentIds
     */
    public function attachDepartments(array $departmentIds)
    {
        $this->roleDepartments()->delete();
        foreach ($departmentIds as $departmentId) {
            $this->roleDepartments()->create([
                'department_id' => $departmentId
            ]);
        }
    }

    /**
     * @return bool
     */
    public function isSuper(): bool
    {
        return $this->label == 'admin';
    }


    /**
     * @return array
     */
    public function getDepartmentIds(): array
    {
        return $this->roleDepartments()->get(['department_id'])->pluck('department_id')->toArray();
    }

    /**
     * @return array
     */
    public function getMenuIds(): array
    {
        return $this->roleMenus()->get(['menu_id'])->pluck('menu_id')->toArray();
    }


    /**
     * @return Builder[]|Collection
     */
    public function getMenus(): Collection|array
    {
        $menuIds = $this->roleMenus()->get(['menu_id'])->pluck('menu_id')->toArray();

        return AdminMenu::query()->whereIn('id', $menuIds)->get();
    }

    /**
     * @return array
     */
    public function getMenuPerms(): array
    {
        $menuIds = $this->roleMenus()->get(['menu_id'])->pluck('menu_id')->toArray();

        return AdminMenu::query()->whereIn('id', $menuIds)->get(['perms'])->pluck('perms')->filter()->values()->toArray();
    }
}

