<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected array $data = [
        [
            'email' => 'admin@upay.pet',
            'password' => 'admin',
        ],
    ];

    public function run(): void
    {
        collect($this->data)
            ->map(function (array $data) {
                $data['password'] = bcrypt($data['password']);

                User::query()->create($data);
            });
    }
}
