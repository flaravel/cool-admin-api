<?php

namespace Cool\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'                  => $this->id,
            'name'                => $this->name,
            'label'               => $this->label,
            'remark'              => $this->remark,
            'departmentIdList'    => $this->getDepartmentIds(),
            'menuIdList'          => $this->getMenuIds(),
            'createTime'          => Carbon::parse($this->created_at)->toDateTimeString(),
            'updateTime'          => Carbon::parse($this->updated_at)->toDateTimeString(),
        ];
    }
}
