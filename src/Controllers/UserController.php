<?php

namespace Cool\Controllers;

use Cool\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Cool\Resources\UsersResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class UserController extends CoolBaseController
{
    /**
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return $this->success(new UsersResource(Auth::guard('cool')->user()));
    }


    /**
     * @return Builder
     */
    public function model(): Builder
    {
        return AdminUser::query();
    }


    /**
     * @return string
     */
    public function resource(): string
    {
        return UsersResource::class;
    }


    /**
     * @param Builder $query
     * @param Request $request
     */
    protected function queryWhere(Builder $query, Request $request)
    {
        $departmentIds = $request->input('departmentIds');
        $order = $request->input('order');
        $sort = $request->input('sort');
        $keyWord = $request->input('keyWord');

        if ($departmentIds) {
            $query->whereIn('department_id', $departmentIds);
        }

        if ($order && $sort) {
            $orderData = [
                'createTime' => 'created_at'
            ];
            $query->orderBy($orderData[$order], $sort);
        }

        if ($keyWord) {
            $query->where('name', $keyWord)->orWhere('phone', $keyWord);
        }

        $query->where('id','!=', 1); // 超级管理员不展示
    }


    /**
     * @param array $validated
     * @param Request $request
     *
     * @return array
     */
    protected function formatValidatedData(array $validated, Request $request): array
    {
        $status = $validated['status'];
        $validated = array_filter($validated);
        $this->getValidationFactory()->make($validated, [
            'phone' => 'regex:/^1[345789][0-9]{9}$/',
            'email' => 'email',
            'head_img' => 'url'
        ], [
            'phone.regex' => '手机号格式不正确',
            'email.email' => '邮箱格式不正确',
        ])->validate();

        if (isset($validated['password']) && $validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $validated['avatar'] = $validated['head_img'] ?? '';
        $validated['status'] = $status ?? 1;
        return $validated;
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function updated($model, Request $request)
    {
        $roleIds = $request->input('roleIdList');
        $model->attachRole($roleIds);
    }


    /**
     * @param $model
     * @param Request $request
     */
    protected function created($model, Request $request)
    {
        $roleIds = $request->input('roleIdList');
        $model->attachRole($roleIds);
    }
}
