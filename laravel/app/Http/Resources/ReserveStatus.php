<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveStatus extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'allow' => $this->allow,
            'reserve_icon_id' => $this->reserve_icon_id,
            'order' => $this->order,
            'status' => $this->status,

        ];
    }
}
