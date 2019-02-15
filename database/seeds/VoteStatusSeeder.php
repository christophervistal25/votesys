<?php

use Illuminate\Database\Seeder;
use App\VoteStatus;

class VoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VoteStatus::create(['status' => 'closed']);
    }
}
