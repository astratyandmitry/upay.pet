<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $paid = (bool) rand(0, 1);

        return [
            'uuid' => (string) Str::uuid(),
            'status_id' => $paid ? PAYMENT_STATUS_PAID : Arr::random([PAYMENT_STATUS_PENDING, PAYMENT_STATUS_CANCELED]),
            'amount' => round(rand(100, 10000) / 100, 2),
            'description' => $paid ? $this->faker->sentence : null,
            'paid_at' => $paid ? $this->faker->dateTimeBetween('-1 year') : null,
        ];
    }
}
