<?php

use Cool\Models\AdminUser;

return [

    'route' => [

        'prefix' =>  'cool'
    ],

    'models' => [

        // 用户模型
        'user' => AdminUser::class
    ]
];
