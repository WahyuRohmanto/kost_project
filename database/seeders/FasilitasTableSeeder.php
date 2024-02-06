<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FasilitasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fasilitas')->delete();
        $new_fasilitas = [
        [
            'id' => 1,
            'fasilitas' => 'Kamar Mandi Dalam',
        ],
        [
            'id' => 2,
            'fasilitas' => 'AC',
        ],
        [
            'id' =>3,
            'fasilitas' => 'Listrik',
        ]
        ];
        DB::table('fasilitas')->insert($new_fasilitas);
    }
}
