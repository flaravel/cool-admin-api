<?php

namespace Cool\Controllers;

use Cool\Cool;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Cool\Traits\CurdEventTrait;
use Illuminate\Http\JsonResponse;
use Cool\Constructs\CurdInterface;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Cool\Traits\ResponseTrait as CoolResponseTrait;

abstract class CoolBaseController extends Controller implements CurdInterface
{
    use CoolResponseTrait, CurdEventTrait;


    /**
     * @return JsonResponse
     */
    public function lists(): JsonResponse
    {
        $lists = $this->model()->get();

        return $this->success($this->responseWithResource($lists));
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function page(Request $request): JsonResponse
    {
        $size = $request->input('size', 15);

        $data = $this->model()->where(function ($query) use ($request) {
            $this->queryWhere($query, $request);
        })->latest()->paginate($size);

        return $this->success($this->responseWithResource($data));
    }



    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validated = Cool::snake($request->all());

        $created =  $this->model()->create($this->formatValidatedData($validated,$request));

        if ($created) {
            $this->created($created, $request);
            return $this->message('添加成功');
        }
        return $this->error('添加失败');
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $id = $request->input('id', 0);

        $model = $this->model()->findOrFail($id);

        return $this->success($this->responseWithResource($model));
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = Cool::snake($request->all());

        $id = $validated['id'] ?? 0;
        if (!$id) {
            return $this->error('更新失败');
        }

        $model = $this->model()->where('id', $id)->first();

        if (!$model) {
            return $this->error('更新失败');
        }

        $updated = $model->update($this->formatValidatedData($validated,$request));

        if ($updated) {
            $this->updated($model, $request);
            return $this->message('更新成功');
        }
        return $this->error('更新失败');
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return $this->error('删除失败');
        }
        $models = $this->model()->whereIn('id', $ids)->get();
        if ($models->isEmpty()) {
            return $this->error('删除失败');
        }
        foreach ($models as $model) {
            $response = $this->deleting($model);
            if ($response instanceof JsonResponse) {
                return $response->send();
            }
            $model->delete();
        }

        return $this->message('删除成功');
    }


    /**
     * @param array $validated
     * @param Request $request
     *
     * @return array
     */
    protected function formatValidatedData(array $validated, Request $request): array
    {
        return $validated;
    }


    /**
     * @param Collection|LengthAwarePaginator|Model $data
     *
     * @return mixed
     */
    protected function responseWithResource(mixed $data): mixed
    {
        $resource = $this->resource();

        if (empty($resource)) {
            return $this->formatResponseData($data);
        }
        if (!is_subclass_of($resource, JsonResource::class)) {
            throw new InvalidArgumentException(sprintf('resource [%s] is not instanceof JsonResource', $resource));
        }
        if ($data instanceof LengthAwarePaginator) {
            $formatData = $this->formatResponseData($data);
            $formatData['list'] = $resource::collection($formatData['list']);
            return $formatData;
        }
        if ($data instanceof Collection) {
            return $resource::collection($data);
        }
        return new $resource($data);
    }


    /**
     * @param mixed $data
     *
     * @return mixed
     */
    protected function formatResponseData(mixed $data): mixed
    {
        if ($data instanceof LengthAwarePaginator) {
            return [
                'list' => $data->items(),
                'pagination' => [
                    'page' => $data->currentPage(),
                    'size' => $data->perPage(),
                    'total' => $data->total(),
                ]
            ];
        }
        return $data;
    }
}
