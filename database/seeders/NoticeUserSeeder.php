<?php

namespace Database\Seeders;

use App\Models\NoticeUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nbrOfNoticeUser = 5;
        NoticeUser::factory($nbrOfNoticeUser)->create();
    }
}
