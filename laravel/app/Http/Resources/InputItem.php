<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InputItem extends JsonResource
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
            'input_type_id' => $this->input_type_id,
            'status' => $this->status,
            'required' => $this->required,
            'order' => $this->order,
            'status' => $this->status,
            'explain' => $this->explain,
            'input_selections' => InputSelection::collection($this->input_selections),
            'identify_name' => $this->identify_name,
        ];
    }
}
