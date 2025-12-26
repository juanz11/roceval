<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@roceval.local'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('Admin12345'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'visitante@roceval.local'],
            [
                'name' => 'Visitante',
                'password' => Hash::make('Visitante12345'),
                'role' => 'visitor',
            ]
        );
    }
}
