<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\PaymentStatus
 */
class PaymentStatusResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'key' => $this->key,
        ];
    }
}
