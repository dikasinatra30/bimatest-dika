<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "reff" => $this->reff,
            "name" => $this->name,
            "expired" => $this->expired_at,
            "paid" => $this->paid_at,
            "code" => $this->code,
            "status" => $this->statusLabel,
        ];
    }
}
