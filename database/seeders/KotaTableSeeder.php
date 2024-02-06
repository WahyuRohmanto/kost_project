<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class KotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kota')->delete();
        $new_kota = [
        [
            'id' => 1,
            'nama_kota' => 'Jakarta',
        ],
        [
            'id' => 2,
            'nama_kota' => 'Garut',
        ],
        [
            'id' =>3,
            'nama_kota' => 'Bandung',
        ]
        ];
        DB::table('kota')->insert($new_kota);
    }
}
