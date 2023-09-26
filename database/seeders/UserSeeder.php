<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
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
                //1
                'course_id' => NULL,
                'email' => 'super-admin@email.com', 
                'password' => Hash::make('super-admin@email.com'),
                'student_number' => NULL, 
                'first_name' => 'Super Admin',
                'middle_name' => 'I',
                'last_name' => 'Am',
                'date_of_birth' => '2000-01-01',
                'contact_number' => '+639123456124',
                'address' => 'Taguig',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'year_and_section' => NULL,
                'applying_as' => 'Super Admin',
                'status' => 'approved'
            ],
            [
                //2
                'course_id' => 1,
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
                'applying_as' => 'Student',
                'status' => 'approved'
            ],
            [
                //3
                'course_id' => NULL,
                'email' => 'adviser@email.com', 
                'password' => Hash::make('adviser@email.com'),
                'student_number' => NULL, 
                'first_name' => 'Adviser',
                'middle_name' => 'I',
                'last_name' => 'Am',
                'date_of_birth' => '2000-01-01',
                'contact_number' => '+639123456124',
                'address' => 'Taguig',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'year_and_section' => NULL,
                'applying_as' => 'Adviser',
                'status' => 'approved'

            ],
            [
                //4
                'course_id' => NULL,
                'email' => 'ojt-coordinator@email.com', 
                'password' => Hash::make('ojt-coordinator@email.com'),
                'student_number' => NULL, 
                'first_name' => 'OJT Coordinator',
                'middle_name' => 'I',
                'last_name' => 'Am',
                'date_of_birth' => '2000-01-01',
                'contact_number' => '+639123456124',
                'address' => 'Taguig',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'year_and_section' => NULL,
                'applying_as' => 'OJT Coordinator',
                'status' => 'approved'
            ],
            // [
            //     //5
            //     'course_id' => NULL,
            //     'email' => 'head-of-academics-program@email.com', 
            //     'password' => Hash::make('head-of-academics-program@email.com'),
            //     'student_number' => NULL, 
            //     'first_name' => 'Head of Academics Program',
            //     'middle_name' => 'I',
            //     'last_name' => 'Am',
            //     'date_of_birth' => '2000-01-01',
            //     'contact_number' => '+639123456124',
            //     'address' => 'Taguig',
            //     'created_at' => $currentTime,
            //     'updated_at' => $currentTime,
            //     'year_and_section' => NULL,
            //     'applying_as' => 'Head of Academics Program',
            //     'status' => 'approved'
            // ],
            // [
            //     //6
            //     'course_id' => NULL,
            //     'email' => 'director@email.com', 
            //     'password' => Hash::make('director@email.com'),
            //     'student_number' => NULL, 
            //     'first_name' => 'Director',
            //     'middle_name' => 'I',
            //     'last_name' => 'Am',
            //     'date_of_birth' => '2000-01-01',
            //     'contact_number' => '+639123456124',
            //     'address' => 'Taguig',
            //     'created_at' => $currentTime,
            //     'updated_at' => $currentTime,
            //     'year_and_section' => NULL,
            //     'applying_as' => 'Director',
            //     'status' => 'approved'
            // ],
          

        ];

        DB::table('users')->insert($data);
    }
}