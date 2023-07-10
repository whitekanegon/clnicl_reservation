<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegularWeek extends JsonResource
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
            'clinical_item_id' => $this->clinical_item_id,
            'week_id' => $this->week_id,
            'reserve_times_set_id' => $this->reserve_times_set_id,
            'reserve_status_id' => $this->reserve_status_id,
        ];
    }
}
