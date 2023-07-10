<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicalItem extends JsonResource
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
            'order' => $this->order,
            'status' => $this->status,
            'reserve_timing' => $this->reserve_timing,
            'reserve_include_holiday' => $this->reserve_include_holiday,
            'calendar_length' => $this->calendar_length,
            'reserve_calendars' => ReserveCalendar::collection($this->reserve_calendars),
            'regular_holidays' => RegularHoliday::collection($this->regular_holidays),
            'regular_weeks' => RegularWeek::collection($this->regular_weeks),
        ];
    }
}
