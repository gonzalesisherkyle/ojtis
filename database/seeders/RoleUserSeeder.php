<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                // Super Admin  
                'user_id' => 1,
                'role_id' => 1,
            ],
            [
                // Student 
                'user_id' => 2,
                'role_id' => 4,
            ],
            [
                // ADVISER  
                'user_id' => 3,
                'role_id' => 2,
            ],
            [
                // OJT Coordinator
                'user_id' => 4,
                'role_id' => 3,
            ],
            // [
            //     // Head of Academics Program
            //     'user_id' => 5,
            //     'role_id' => 7,
            // ],
            // [
            //     // Director
            //     'user_id' => 6,
            //     'role_id' => 6,
            // ],
        ];
        DB::table('tbl_role_user')->insert($data);
    }
}
