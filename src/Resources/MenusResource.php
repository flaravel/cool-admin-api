<?php

namespace Cool\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenusResource extends JsonResource
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
            'router'    => $this->router,
            'perms'     => $this->perms,
            'type'      => $this->type,
            'icon'      => $this->icon,
            'orderNum'  => $this->order_num,
            'viewPath'  => $this->view_path,
            'keepAlive' => $this->keep_alive,
            'isShow'    => $this->is_show,
            'updateTime' => Carbon::parse($this->updated_at)->toDateTimeString(),
        ];
    }
}
