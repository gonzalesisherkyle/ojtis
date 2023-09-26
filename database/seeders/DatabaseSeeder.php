<?php

namespace Database\Seeders;

use Faker\Provider\UserAgent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CourseSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            FileCategorySeeder::class,
            StudentSeeder::class,
            MoaListSeeder::class,
        ]);
    }
}
