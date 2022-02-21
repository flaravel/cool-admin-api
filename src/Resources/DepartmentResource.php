<?php

namespace Cool\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'parentId'  => $this->parent_id,
            'name'      => $this->name,
            'orderNum'  => $this->order_num,
        ];
    }
}
