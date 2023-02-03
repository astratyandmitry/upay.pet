<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Client
 */
class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'deleted' => $this->deleted_at !== null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'payments' => $this->when($this->relationLoaded('payments'), PaymentResource::collection($this->payments)),
        ];
    }
}
