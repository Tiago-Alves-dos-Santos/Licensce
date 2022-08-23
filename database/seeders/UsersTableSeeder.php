<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Tiago Alves',
            'email' => 'admin@admin.com',
            'login' => 'tiagoSoft2001',
            'password' => Hash::make('masterkey'),
            'tipo' => 'dev_admin',
            'ativo' => 'Y'
        ]);
    }
}
