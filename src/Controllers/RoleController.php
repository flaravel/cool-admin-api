<?php

namespace Cool\Controllers;

use Cool\Models\AdminMenu;
use Cool\Models\AdminRole;
use Illuminate\Http\Request;
use Cool\Resources\RoleResource;
use Illuminate\Http\JsonResponse;
use Cool\Resources\MenusResource;
use Illuminate\Database\Eloquent\Builder;

class RoleController extends CoolBaseController
{
    /**
     * @return Builder
     */
    public function model(): Builder
    {
        return AdminRole::query();
    }


    protected function queryWhere(Builder $query, Request $request)
    {
        $keyWord = $request->input('keyWord');

        if ($keyWord) {
            $query->where('name', $keyWord)->orWhere('label', $keyWord);
        }
    }


    /**
     * @return string
     */
    public function resource(): string
    {
        return RoleResource::class;
    }


    /**
     * @param array $validated
     * @param Request $request
     *
     * @return array
     */
    protected function formatValidatedData(array $validated, Request $request): array
    {
        return [
            'relevance' => $validated['relevance'],
            'name' => $validated['name'],
            'label' => $validated['label'],
            'remark' => $validated['remark'] ?? '',
        ];
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function created($model, Request $request)
    {
        $this->attachPerms($model, $request);
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function updated($model, Request $request)
    {
        $this->attachPerms($model, $request);
    }


    /**
     * @param $model
     *
     * @return JsonResponse|void
     */
    public function deleting($model)
    {
        if ($model->isSuper()) {
            return $this->error('超管角色无法删除');
        }
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function attachPerms($model, Request $request)
    {
        $menuIds = $request->input('menuIdList');
        $departmentIds = $request->input('departmentIdList');
        $model->attachMenus($menuIds);
        $model->attachDepartments($departmentIds);
    }
}
