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
                "created_at" => Carbon::now(),
            ],
            [
                "role" => "author",
                "created_at" => Carbon::now(),
            ],
            [
                "role" => "user",
                "created_at" => Carbon::now(),
            ],
        ]);

        $Roles->each(function($role) {
            DB::table('roles')->insert($role);
        });
    }
}
