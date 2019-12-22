<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Category = collect([
            [
                "name" => "News",
                "slug" => "news",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "name" => "Sports",
                "slug" => "sport",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "name" => "International",
                "slug" => "international",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "name" => "Indonesian",
                "slug" => "indonesian",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "name" => "Technology",
                "slug" => "tech",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ]
        ]);

        $Category->each(function($cat) {
            DB::table('category')->insert($cat);
        });
    }
}
