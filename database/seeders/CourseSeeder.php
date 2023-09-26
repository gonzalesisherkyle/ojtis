<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
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
                'course_name' => 'Bachelor of Science in Accountancy',
                'course_abb' => 'BSA'
            ],
            [
                'course_name' => 'Bachelor of Science in Electronics and Communication Engineering',
                'course_abb' => 'BSECE'
            ],
            [
                'course_name' => 'Bachelor of Science Mechanical Engineering',
                'course_abb' => 'BSME'
            ],
            [
                'course_name' => 'Bachelor of Science in Business Administration Major in Human Resource Development Management',
                'course_abb' => 'BSBA-HRDM'
            ],
            [
                'course_name' => 'Bachelor of Science in Business Administration Major in Marketing Management',
                'course_abb' => 'BSBA-MM'
            ],
            [
                'course_name' => 'Bachelor of Science in Office Administration Major in Legal Transcription',
                'course_abb' => 'BSOA-LT'
            ],
            [
                'course_name' => 'Bachelor of Secondary Education Major in English',
                'course_abb' => 'BSED-English'
            ],
            [
                'course_name' => 'Bachelor of Secondary Education Major in Mathematics',
                'course_abb' => 'BSED-Mathematics'
            ],
            [
                'course_name' => 'Bachelor of Science in Information Technology',
                'course_abb' => 'BSIT'
            ],
            [
                'course_name' => 'Diploma in Office Management Technology with Specialization in Legal Office Management',
                'course_abb' => 'DOMT'
            ],
            [
                'course_name' => 'Diploma in Information Communication Technology',
                'course_abb' => 'DICT'
            ],
        ];
        DB::table('tbl_courses')->insert($data);
    }
}
