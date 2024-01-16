<?php

namespace Database\Seeders;

use App\Models\NoticeCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nbrOfNoticeCompany = 5;
        NoticeCompany::factory($nbrOfNoticeCompany)->create();
    }
}
