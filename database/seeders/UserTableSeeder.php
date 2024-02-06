<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $new_user = [
        [
            'id' => 1,
            // 'name' => fake()->name(),
            'name' => 'Asep Sahrudin',
            'role' => 'admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ],
        [
            'id' => 2,
            // 'name' => fake()->name(),
            'name' => 'Pemilik kost',
            'role' => 'pemilik',
            'email' => 'pemilik@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pemilik'),
            'remember_token' => Str::random(10),
        ],
        [
            'id' =>3,
            // 'name' => fake()->name(),
            'name' => 'Penyewa kost',
            'role' => 'customer',
            'email' => 'customer@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer'),
            'remember_token' => Str::random(10),
        ]
        ];
        DB::table('users')->insert($new_user);
    }
}
