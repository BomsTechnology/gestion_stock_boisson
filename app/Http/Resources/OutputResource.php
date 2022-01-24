<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OutputResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'person' => $this->customer_id,
            'amount' => $this->amount,
            'date' => $this->created_at,
            'type' => 'Sorties'
            // 'drinks' => $this->whenPivotLoaded('moves', function () {
            //     return $this->pivot->drinks;
            // }),
            // 'drinks' => $this->id;
        ];
    }
}
