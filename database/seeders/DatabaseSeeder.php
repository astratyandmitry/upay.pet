<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PaymentStatusSeeder::class,
        ]);

        Client::factory()->count(20)
            ->has(Payment::factory()->count(10))
            ->create();
    }
}
