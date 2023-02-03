<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    protected array $data = [
        [
            'id' => PAYMENT_STATUS_PENDING,
            'label' => 'Pending',
            'key' => 'pending',
        ],
        [
            'id' => PAYMENT_STATUS_PAID,
            'label' => 'Paid',
            'key' => 'paid',
        ],
        [
            'id' => PAYMENT_STATUS_CANCELED,
            'label' => 'Canceled',
            'key' => 'canceled',
        ],
    ];

    public function run(): void
    {
        collect($this->data)
            ->map(fn(array $data) => PaymentStatus::query()->create($data));
    }
}
