<?php

namespace Cool;

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Builder;

class Cool
{
    /**
     * 获取Cool管理员用户模型
     *
     * @return Builder
     */
    public static function user(): Builder
    {
        $user = config('cool.models.user');

        if (!$user) {
            throw new InvalidArgumentException('cool user model is empty');
        }

        if (!class_exists($user)) {
            throw new InvalidArgumentException('cool user model is not class');
        }
        return (new $user)->query();
    }

    /**
     * 将驼峰数组key转为snake
     *
     * @param array $data
     *
     * @return array
     */
    public static function snake(array $data): array
    {
        $newData = [];
        foreach ($data as $key => $value) {
            $newData[str()->snake($key)] = $value;
        }
        return $newData;
    }
}
