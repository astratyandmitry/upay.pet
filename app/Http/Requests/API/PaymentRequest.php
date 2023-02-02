<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $client_id
 * @property float $amount
 * @property string|null $description
 */
class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|max:500',
        ];
    }
}
