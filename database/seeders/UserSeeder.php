<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Ahmed',
            'last_name' => 'Safwat',
            'full_name' => 'Ahmed Safwat',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'birth_date' => '2007-06-10',
            'gender' => 'male',
            'banned' => false,
        ]);

        User::factory(19)->create();
    }
}
