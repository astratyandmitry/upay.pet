<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Payment
 */
class PaymentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'amount' => round($this->amount, 2),
            'description' => $this->description,
            'status' => new PaymentStatusResource($this->status),
            'client' => new ClientResource($this->client),
            'paid_at' => $this->paid_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
