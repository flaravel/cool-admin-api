<?php

use Cool\Controllers\AuthController;
use Cool\Controllers\UserController;
use Cool\Controllers\MenuController;
use Cool\Controllers\RoleController;
use Cool\Controllers\CommonController;
use Cool\Controllers\DepartmentController;

Route::group(['prefix' => config('cool.route.prefix')], function () {


    Route::post('login', [AuthController::class, "login"]);

    Route::post('logout', [AuthController::class, "logout"]);

    Route::group(['middleware' => 'auth:cool'], function () {

        // 文件上传
        Route::get('uploadMode', [CommonController::class, "uploadMode"]);
        Route::post('upload', [CommonController::class, "upload"]);

        // 管理员信息
        Route::get('user', [UserController::class, "user"]);

        // 权限菜单
        Route::get('permmenu', [MenuController::class, "perms"]);

        Route::group(['prefix' => 'system'], function () {

            Route::get('user/info', [UserController::class, "show"]);
            Route::post('user/page', [UserController::class, "page"]);
            Route::post('user/delete', [UserController::class, "delete"]);
            Route::post('user/add', [UserController::class, "create"]);
            Route::post('user/update', [UserController::class, "update"]);

            // 角色
            Route::get('role/list', [RoleController::class, "lists"]);
            Route::post('role/page', [RoleController::class, "page"]);
            Route::post('role/add', [RoleController::class, "create"]);
            Route::post('role/update', [RoleController::class, "update"]);
            Route::post('role/delete', [RoleController::class, "delete"]);
            Route::get('role/info', [RoleController::class, "show"]);

            // 部门
            Route::get('department/list', [DepartmentController::class, "lists"]);
            Route::post('department/add', [DepartmentController::class, "create"]);
            Route::post('department/update', [DepartmentController::class, "update"]);
            Route::post('department/delete', [DepartmentController::class, "delete"]);
            Route::get('department/info', [DepartmentController::class, "show"]);
            Route::post('department/order', [DepartmentController::class, "order"]);

            // 菜单
            Route::get('menu/list', [MenuController::class, "lists"]);
            Route::post('menu/delete', [MenuController::class, "delete"]);
            Route::post('menu/add', [MenuController::class, "create"]);
            Route::get('menu/info', [MenuController::class, "show"]);
            Route::post('menu/update', [MenuController::class, "update"]);
        });
    });
});

