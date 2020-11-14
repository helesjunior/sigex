<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Heles Junior',
            'email' => 'helesjunior@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'PJw4muvkwK',
            'language' => 'pt_br'
        ]);

        \App\Models\User::create([
            'name' => 'Anderson Sathler',
            'email' => 'asathler@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'iAVpRQt4S9',
            'language' => 'en'
        ]);

        \App\Models\User::create([
            'name' => 'Saulo Soares',
            'email' => 'saulosao@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'Kwkvum4wJP',
            'language' => 'en'
        ]);

        \App\Models\User::create([
            'name' => 'Franklin Silva',
            'email' => 'franklin.linux@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => '9S4tQRpVAi',
            'language' => 'pt_br'
        ]);
    }
}
