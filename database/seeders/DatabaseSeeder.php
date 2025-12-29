<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Demo User
        User::firstOrCreate([
            'email' => 'demo@example.com',
        ], [
            'name' => 'Administrador Demo',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Seed 50 Contacts for quick starts (optional, main method is CSV)
        if (Contact::count() == 0) {
            $data = [];
            for ($i = 0; $i < 50; $i++) {
                $data[] = [
                    'email' => "usuario{$i}_" . Str::random(5) . "@ejemplo.com",
                    'name' => "Usuario $i",
                    'status' => 'valid',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Contact::insert($data);
        }
    }
}
