<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // 1
            ['role_name' => 'Super Admin'],
            // 2
            ['role_name' => 'Adviser'],
            // 3
            ['role_name' => 'OJT Coordinator'],
            // 4
            ['role_name' => 'Student'],
            //5
            ['role_name' => 'Unassigned'],
            // //6
            // ['role_name' => 'Director'],
            // //7
            // ['role_name' => 'Head of Academics Program'],
        ];
        DB::table('tbl_roles')->insert($data);
    }
}
