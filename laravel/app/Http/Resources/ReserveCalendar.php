<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveCalendar extends JsonResource
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
            'date' => $this->date,
            'clinical_item_id' => $this->clinical_item_id,
            'reserve_status_id' => $this->reserve_status_id,
            'reserve_timing' => $this->reserve_timing,
            'reserve_times_set_id' => $this->reserve_times_set_id,
        ];
    }
}
