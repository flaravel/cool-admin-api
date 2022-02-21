<?php

namespace Cool\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cool\Traits\ResponseTrait as CoolResponseTrait;

class CommonController extends Controller
{
    use CoolResponseTrait;

    /**
     * @return JsonResponse
     */
    public function uploadMode(): JsonResponse
    {
        return $this->success([
            'mode' => 'local',
        ]);
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        /*
        * @var $files UploadedFile[]
        */
        if (empty($request->file('file'))) {
            return $this->success([]);
        }
        $files = is_array($request->file('file')) ? $request->file('file') : [$request->file('file')];

        $path = $request->get('path', date('Ymd'));

        $fileArr = [];

        foreach ($files as $file) {
            if ($file->isValid()) {
                $fileArr[] = Storage::url($file->store(is_null($path) ? '/' : $path));
            }
        }

        return $this->success(count($fileArr) > 1 ? $fileArr : current($fileArr));
    }
}
