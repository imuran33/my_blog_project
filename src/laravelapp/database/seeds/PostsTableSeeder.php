<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;    //追記
use Carbon\Carbon;    //追記

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'LaravelでCRUDを作った話',
                'content' => 'Laravelで簡単にCRUD機能を構築できました。',
                'category' => 'programming',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ギター練習日記',
                'content' => '今日はFコードが鳴らせた！',
                'category' => 'music',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
