<?php

namespace Cool\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'username'      => $this->username,
            'headImg'       => $this->avatar,
            'status'        => $this->status,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'nickName'      => $this->nick_name,
            'remark'        => $this->remark,
            'departmentName'=> optional($this->department)->name ?? '',
            'departmentId'  => $this->department_id,
            'roleName'      => $this->getRoleString(),
            'roleIdList'    => $this->getRoleIds(),
            'createTime'    => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
