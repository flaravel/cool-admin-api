<?php

namespace Cool\Controllers;

use Cool\Cool;
use Cool\Models\AdminMenu;
use Illuminate\Http\Request;
use Cool\Models\AdminDepartment;
use Cool\Resources\MenusResource;
use Illuminate\Http\JsonResponse;
use Cool\Resources\DepartmentResource;
use Illuminate\Database\Eloquent\Builder;

class DepartmentController extends CoolBaseController
{
    /**
     * @return Builder
     */
    public function model(): Builder
    {
        return AdminDepartment::query();
    }


    /**
     * @return string
     */
    public function resource(): string
    {
        return DepartmentResource::class;
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function order(Request $request): JsonResponse
    {
        foreach ($request->all() as $value) {
            $this->model()->where('id', $value['id'])->update([
                'parent_id' => $value['parentId'] ?? 0,
                'order_num' => $value['orderNum']
            ]);
        }
        return $this->message('设置成功');
    }
}
