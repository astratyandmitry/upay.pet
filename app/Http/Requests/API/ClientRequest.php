<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $full_name
 * @property string $email
 * @property string $phone
 */
class ClientRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'full_name' => 'required|max:120',
            'email' => ['required|email'],
            'phone' => 'required|max:20'
        ];

        if ($this->getMethod() === 'POST') {
            $rules['email'][] = 'unique:clients,email';
        }

        if ($this->getMethod() === 'PUT') {
            $rules['email'][] = 'unique:clients,email,' . $this->route('client')->id;
        }

        return $rules;
    }
}
