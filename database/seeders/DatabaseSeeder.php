<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $nbrOfUsers = 10;
        User::factory($nbrOfUsers)->create();       
        $this->call(CompanySeeder::class);
        $this->call(LocationSeeder::class);   
        $this->call(JobSeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(NoticeCompanySeeder::class);
        $this->call(NoticeUserSeeder::class);
    }
}
