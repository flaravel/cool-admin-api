<?php

namespace Cool;

use Illuminate\Support\Str;

class Cool
{
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
            $newData[Str::snake($key)] = $value;
        }
        return $newData;
    }
}
