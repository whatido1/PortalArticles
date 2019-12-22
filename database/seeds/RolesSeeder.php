<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Roles = collect([
            [
                "role" => "admin",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "role" => "author",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "role" => "user",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
        ]);

        $Roles->each(function($role) {
            DB::table('roles')->insert($role);
        });
    }
}
