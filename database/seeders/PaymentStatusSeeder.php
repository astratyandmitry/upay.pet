<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    protected array $data = [
        [
            'id' => PAYMENT_STATUS_PENDING,
            'label' => 'Ожидает оплаты',
            'key' => 'pending',
        ],
        [
            'id' => PAYMENT_STATUS_PAID,
            'label' => 'Оплачен',
            'key' => 'paid',
        ],
        [
            'id' => PAYMENT_STATUS_CANCELED,
            'label' => 'Отменен',
            'key' => 'canceled',
        ],
    ];

    public function run(): void
    {
        collect($this->data)
            ->map(fn(array $data) => PaymentStatus::query()->create($data));
    }
}
