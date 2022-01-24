<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InputResource extends JsonResource
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
            'person' => $this->provider_id,
            'amount' => $this->amount,
            'date' => $this->created_at,
            'type' => 'Entrées'
            // 'drinks' => $this->whenPivotLoaded('moves', function () {
            //     return $this->pivot->drinks;
            // }),
            // 'drinks' => $this->id;
        ];
    }
}
