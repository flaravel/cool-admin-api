<?php

namespace Cool\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

trait ResponseTrait
{

    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     *
     * @return JsonResponse
     */
    public function response($data, string $message = 'ok', int $code = 0): JsonResponse
    {
        return Response::json(['code' => $code, 'message' => $message, 'data' => $data])
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    public function error(string $message = ''): JsonResponse
    {
        return $this->response(NULL, $message, -1);
    }


    /**
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function success($data): JsonResponse
    {
        return $this->response($data);
    }


    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    public function message($message = 'ok'): JsonResponse
    {
        return $this->response(NULL, $message);
    }
}
