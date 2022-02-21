<?php

namespace Cool\Controllers;

use Cool\Models\AdminMenu;
use Cool\Models\AdminUser;
use Illuminate\Http\JsonResponse;
use Cool\Resources\MenusResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MenuController extends CoolBaseController
{

    /**
     * @return JsonResponse
     */
    public function perms(): JsonResponse
    {
        /**@var $user AdminUser*/
        $user = Auth::guard('cool')->user();

        return $this->success([
            'menus' => MenusResource::collection($user->getMenus()),
            'perms' => $user->getPerms(),
        ]);
    }


    /**
     * @return Builder
     */
    public function model(): Builder
    {
        return AdminMenu::query();
    }


    /**
     * @return string
     */
    public function resource(): string
    {
        return MenusResource::class;
    }


    /**
     * @param $model
     *
     * @return JsonResponse|void
     */
    protected function deleting($model)
    {
        if ($model->children()->exists()) {
            return $this->error('请先删除子级菜单');
        }
    }
}
