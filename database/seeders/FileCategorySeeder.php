<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileCategorySeeder extends Seeder
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
                'category_name' => 'Daily Documentation',
            ],
            [
                'category_name' => 'Daily Time-in and Time-out',
            ],
            [
                'category_name' => 'Weekly Accomplishment Report',
            ],
            [
                'category_name' => 'Resume',
            ],
            [
                'category_name' => 'Webinar Certificates',
            ],
            [
                'category_name' => 'LinkedIn, Jobstreet, Github Account',
            ],
            [
                'category_name' => 'Network and Linkages',
            ],
            [
                'category_name' => 'Recommendation Letter',
            ],
            [
                'category_name' => 'Memorandum of Agreement',
            ],
            [
                'category_name' => 'Student Information Sheet',
            ],
            [
                'category_name' => 'Training Partner Information Sheet',
            ],
            [
                'category_name' => 'Practicum Students Evaluation of Training Partner and Supervisor',
            ],
            [
                'category_name' => 'Certificate of Completion (COC)',
            ],
            [
                'category_name' => 'Training Manual',
            ],
            [
                'category_name' => 'Acceptance Letter',
            ],
            [
                'category_name' => 'Others',
            ],
        ];
        DB::table('tbl_file_categories')->insert($data);
    }
}
