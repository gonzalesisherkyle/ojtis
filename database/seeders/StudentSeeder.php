<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $data = [
            [
                'course_id' => 1,
                'adviser_id' => 3,
                'email' => 'test-student@email.com', 
                'password' => Hash::make('test-student@email.com'),
                'student_number' => '0000-00000-TG-0', 
                'first_name' => 'Test Student',
                'middle_name' => 'I',
                'last_name' => 'Am',
                'date_of_birth' => '2000-01-01',
                'contact_number' => '+639123456124',
                'address' => 'Taguig',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'year_and_section' => '3-1',
            ],
        ];
        
        DB::table('tbl_students')->insert($data);
    }
}
