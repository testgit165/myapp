<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KanrisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kanris')->insert([
            'bikou' => "備考テスト",
            'user_id' => 1,
            'info' => ""
            ]);
    }
}
